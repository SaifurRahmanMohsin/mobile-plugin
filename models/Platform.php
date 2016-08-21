<?php namespace Tempestronics\Mobile\Models;

use Model;

/**
 * Platform Model
 */
class Platform extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'tempestronics_mobile_platforms';

    /**
     * @var boolean Turn off timestamps on this model
     */
    public $timestamps = false;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['name'];

    /**
     * @var array Reserved platform names.
     */
     protected static $reserved = [
       'android' => 'Tempestronics.Android'
     ];

    public static function isReserved($str)
    {
      return array_key_exists($str, self::$reserved);
    }

   public static function getReservedPluginName($slug)
   {
      if(array_key_exists($slug, self::$reserved))
        return self::$reserved[$slug];
   }

    /**
     * @var array Relations
     */
    public $belongsToMany = [
        'variants' => ['Tempestronics\Mobile\Models\Variant'],
    ];

}
