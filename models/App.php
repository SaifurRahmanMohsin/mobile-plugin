<?php namespace Tempestronics\Mobile\Models;

use Model;

/**
 * App Model
 */
class App extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'tempestronics_mobile_apps';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Relations
     */
    public $hasMany = [
        'variants' => ['Tempestronics\Mobile\Models\Variant'],
    ];

}
