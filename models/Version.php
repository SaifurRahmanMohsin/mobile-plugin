<?php namespace Mohsin\Mobile\Models;

use Model;

/**
 * Version Model
 */
class Version extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'mohsin_mobile_versions';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}