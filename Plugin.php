<?php namespace Tempestronics\Mobile;

use App;
use Backend;
use System\Classes\PluginBase;
use Felixkiss\UniqueWithValidator\ValidatorExtension;

/**
 * Mobile Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['Mohsin.Rest'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'tempestronics.mobile::lang.plugin.name',
            'description' => 'tempestronics.mobile::lang.plugin.description',
            'author'      => 'Tempestronics',
            'icon'        => 'icon-mobile'
        ];
    }

    /**
     * Boot method, called right before the request route.
     */
    public function boot()
    {
        // Register ServiceProviders
        App::register('\Felixkiss\UniqueWithValidator\UniqueWithValidatorServiceProvider');
        // Registering the validator extension with the validator factory
        $this->app['validator']->resolver(function($translator, $data, $rules, $messages)
        {
            // Set custom validation error messages
            $messages['unique_with'] = $translator->get('uniquewith-validator::validation.unique_with');

            return new ValidatorExtension($translator, $data, $rules, $messages);
        });
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'tempestronics.mobile.view_installs' => [
                'tab' => 'tempestronics.mobile::lang.plugin.name',
                'label' => 'tempestronics.mobile::lang.install.view_installs'
            ],
            'tempestronics.mobile.manage_apps' => [
                'tab' => 'Mobile',
                'label' => 'Manage apps'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'apps' => [
                'label'       => 'Apps',
                'description' => 'Manage the apps and their variants.',
                'category'    => 'Mobile',
                'icon'        => 'icon-mobile',
                'url'         => Backend::url('tempestronics/mobile/apps'),
                'order'       => 500,
                'keywords'    => 'apps builds variants',
                'permissions' => ['tempestronics.mobile.manage_apps']
            ],
            'platforms' => [
                'label'       => 'Platforms',
                'description' => 'Manage the available platforms.',
                'category'    => 'Mobile',
                'icon'        => 'icon-th-large',
                'url'         => Backend::url('tempestronics/mobile/platforms'),
                'order'       => 501,
                'keywords'    => 'apps builds variants',
                'permissions' => ['tempestronics.mobile.manage_apps']
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'mobile' => [
                'label'       => 'tempestronics.mobile::lang.plugin.name',
                'url'         => Backend::url('tempestronics/mobile/installs'),
                'icon'        => 'icon-mobile',
                'permissions' => ['tempestronics.mobile.*'],
                'order'       => 500,

                'sideMenu' => [
                    'installs' => [
                        'label'       => 'tempestronics.mobile::lang.plugin.name',
                        'icon'        => 'icon-download',
                        'url'         => Backend::url('tempestronics/mobile/installs'),
                        'order'       => 100,
                        'permissions' => ['tempestronics.mobile.view_installs']
                    ]
                ]
            ],
        ];
    }

}
