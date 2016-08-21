<?php namespace Tempestronics\Mobile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePlatformsTable extends Migration
{

    public function up()
    {
        Schema::create('tempestronics_mobile_platforms', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tempestronics_mobile_platforms');
    }

}
