<?php return [
    'plugin' => [
        'name' => 'Mobile',
        'description' => 'A plugin for mobile apps.',
        'full_name' => 'Mobile'
    ],
    'permission' => [
        'access_campaigns' => 'Allow access to add/delete campaigns.',
        'access_activations' => 'Allow to view the activations.',
    ],
    'install' => [
        'id' => 'ID',
        'label' => 'Install',
        'install_id' => 'Install ID',
        'view_installs' => 'Allow Viewing Installs',
        'manufacturer' => 'Manufacturer',
        'model' => 'Model',
        'installed_on' => 'Installed On',
        'last_opened_on' => 'Last Opened On',
        'invalid_package' => 'Invalid package name',
        'return_to_installs' => 'Back to installs list',
    ],
    'platform' => [
        'is_reserved' => 'This is a reserved keyword. To activate install :name plugin.'
    ],
    'widgets' => [
        'title_installs' => 'App Installs Overview',
    ],
];
