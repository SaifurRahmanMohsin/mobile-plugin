<?php namespace Mohsin\Mobile\Tests;

use App;
use Mohsin\Mobile\Models\App as AppModel;
use Mohsin\Mobile\Models\Install;
use Mohsin\Mobile\Http\Installs;
use Mohsin\Mobile\Models\Variant;
use PluginTestCase;
use System\Classes\PluginManager;
use Felixkiss\UniqueWithValidator\ValidatorExtension;

class InstallTest extends PluginTestCase
{
    private $requestStack;

    public function setUp()
    {
        parent::setUp();

        // Register ServiceProviders
        App::register('\Felixkiss\UniqueWithValidator\UniqueWithValidatorServiceProvider');
        // Registering the validator extension with the validator factory
        $this->app['validator']->resolver(function($translator, $data, $rules, $messages)
        {
            // Set custom validation error messages
            $messages['unique_with'] = $translator->get('uniquewith-validator::validation.unique_with');

            return new ValidatorExtension($translator, $data, $rules, $messages);
        });

        $app = AppModel::create(['name' => 'Sample App', 'description' => 'This is a sample app.']);
        $variant = Variant::create(['app_id' => $app -> id, 'package' => 'com.acme.test', 'platform_id' => 1, 'description' => 'Sample Prod']);

        $app -> variants() -> save($variant);
    }

    public function testSetup()
    {
        $app = AppModel::where('id', '=', 1) -> first();

        $this->assertEquals('Sample App', $app -> name);
        $this->assertEquals('com.acme.test', $app -> variants -> first() -> package);
    }

    public function testInstall()
    {
        $variant = Variant::where('package', '=', 'com.acme.test') -> first();

        $install = new Install;
        $install -> instance_id = '573b61d82b4e46e7';
        $install -> variant_id = $variant -> id;
        $install -> last_seen = $install -> freshTimestamp();
        $install -> save(); // Shouldn't be a force save

        $this->assertEquals('573b61d82b4e46e7', $install -> instance_id);
    }
}
