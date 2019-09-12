<?php namespace Mohsin\Mobile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use Mohsin\Mobile\Models\Platform;

class SeedPlatformsTable extends Migration
{
    public function up()
    {
        Platform::firstOrCreate(['name' => 'iOS', 'slug' => 'ios']);
        Platform::firstOrCreate(['name' => 'Android', 'slug' => 'android']);
    }

    public function down()
    {
        Platform::where('slug', 'ios')->delete();
        Platform::where('slug', 'android')->delete();
    }
}
