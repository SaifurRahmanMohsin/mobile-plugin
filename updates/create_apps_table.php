<?php namespace Tempestronics\Mobile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateAppsTable extends Migration
{

    public function up()
    {
        Schema::create('tempestronics_mobile_apps', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tempestronics_mobile_apps');
    }

}
