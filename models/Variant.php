<?php namespace Tempestronics\Mobile\Models;

use Model;

/**
 * Variant Model
 */
class Variant extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'tempestronics_mobile_variants';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'app' => ['Tempestronics\Mobile\Models\App'],
        'platform' => ['Tempestronics\Mobile\Models\Platform']
    ];

    public $hasMany = [
        'installs' => ['Tempestronics\Mobile\Models\Install']
    ];

}
