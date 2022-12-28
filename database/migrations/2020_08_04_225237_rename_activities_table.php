<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {

            $table->dropForeign(['section_id']);
            
            });
            
            Schema::rename('activities', 'codes');
            
            Schema::table('codes', function (Blueprint $table) {
            
            $table->foreign('section_id')->references('id')->on('sections');
            
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
