<?php namespace Mohsin\Mobile\Http;

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

      if(($variant = Variant::where('package', '=', $package) -> first()) == null)
        return response()->json('invalid-package', 400);
      $variant_id = $variant -> id;

      $install = new Install;
      $install -> instance_id = $instance_id;
      $install -> variant_id = $variant_id;
      $install -> last_seen = $install -> freshTimestamp();

      if($install -> save())
          return response()->json('new-install', 200);
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
