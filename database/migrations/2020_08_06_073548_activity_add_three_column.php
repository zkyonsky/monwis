<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActivityAddThreeColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function(Blueprint $table){
            $table->boolean('bahan_ajar')->default(0);
            $table->boolean('bahan_tayang')->default(0);
            $table->boolean('sap_gbpp')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function(Blueprint $table){
            $table->dropColumn('bahan_ajar');
            $table->dropColumn('bahan_tayang');
            $table->dropColumn('sap_gbpp');
         });
    }
}
