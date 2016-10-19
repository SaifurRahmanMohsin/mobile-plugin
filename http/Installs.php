<?php namespace Mohsin\Mobile\Http;

use Event;
use ApplicationException;
use Backend\Classes\Controller;
use Mohsin\Mobile\Models\Install;
use Mohsin\Mobile\Models\Variant;

/**
 * Installs Back-end Controller
 */
class Installs extends Controller
{
    public $implement = [
        'Mohsin.Rest.Behaviors.RestController'
    ];

    public $restConfig = 'config_rest.yaml';

    public function store()
    {
      $instance_id = post('instance_id');
      $package = post('package');

      // Extensibility - Fire beforeSave Event
      $beforeSaveResponses = Event::fire('mohsin.mobile.beforeSave', [$instance_id, $package]);
      foreach($beforeSaveResponses as $beforeSaveResponse)
        {
          if(!$beforeSaveResponse instanceof \Illuminate\Http\JsonResponse)
            throw new ApplicationException('The event mohsin.mobile.beforeSave can only return JsonResponse');

          if($beforeSaveResponse -> getStatusCode() == 400)
            return $beforeSaveResponse;
        }

      if(($variant = Variant::where('package', '=', $package) -> first()) == null)
        return response()->json('invalid-package', 400);

      // Maintenance mode logic
      if($variant->is_maintenance)
        return response()->json($variant->app->maintenance_message, 503);

      $variant_id = $variant -> id;

      $install = new Install;
      $install -> instance_id = $instance_id;
      $install -> variant_id = $variant_id;
      $install -> last_seen = $install -> freshTimestamp();

      if($install -> save()) {

        // Extensibility - Fire afterSave Event
        $afterSaveResponses = Event::fire('mohsin.mobile.afterSave', [$install]);
        foreach($afterSaveResponses as $afterSaveResponse)
          {
            if(!$afterSaveResponse instanceof \Illuminate\Http\JsonResponse)
              throw new ApplicationException('The event mohsin.mobile.afterSave can only return JsonResponse');

            if($afterSaveResponse -> getStatusCode() == 400)
              return $afterSaveResponse;
          }

          return response()->json('new-install', 200);
        }
      else {
          // See if this is due to conflict, if so update the last_login time and return success
          if(($existingInstall = Install::where('instance_id','=',$instance_id)->where('variant_id','=',$variant_id)) != null)
            {
                $existingInstall -> first() -> touchLastSeen();
                return response()->json('existing-install', 200);
            }

          return response()->json($install->errors()->first(), 400);
        }
    }

}
