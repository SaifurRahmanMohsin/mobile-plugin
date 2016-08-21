<?php namespace Tempestronics\Mobile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateVersionsTable extends Migration
{

    public function up()
    {
        Schema::create('tempestronics_mobile_versions', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tempestronics_mobile_versions');
    }

}
