<?php namespace Tempestronics\Mobile\Controllers;

use Cookie;
use BackendMenu;
use Backend\Classes\Controller;
use Tempestronics\Mobile\Models\Variant;

/**
 * Installs Back-end Controller
 */
class Installs extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    protected $variant_id;

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Tempestronics.Mobile', 'mobile', 'installs');
        $this->vars['variants'] = Variant::lists('description','id');
        $this -> variant_id = Cookie::get('variant_id', 1);
        $this->vars['variant_id'] = $this -> variant_id;
    }

    public function listExtendQuery($query)
    {
        $query->withVariant($this -> variant_id);
    }

    public function onVariantChange()
    {
        $value = post('value');
        Cookie::queue('variant_id', $value, 120);
    }
}
