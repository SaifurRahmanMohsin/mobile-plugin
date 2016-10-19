<?php namespace Mohsin\Mobile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AppsAddMaintenanceMessage extends Migration
{

    public function up()
    {
        Schema::table('mohsin_mobile_apps', function($table)
        {
            $table->string('maintenance_message');
        });
    }

    public function down()
    {
        Schema::table('mohsin_mobile_apps', function($table)
        {
            $table->dropColumn('maintenance_message');
        });
    }

}
