<?php namespace Mohsin\Mobile\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class VariantsAddIsMaintenance extends Migration
{

    public function up()
    {
        Schema::table('mohsin_mobile_variants', function($table)
        {
            $table->boolean('is_maintenance');
        });
    }

    public function down()
    {
        Schema::table('mohsin_mobile_variants', function($table)
        {
            $table->dropColumn('is_maintenance');
        });
    }

}
