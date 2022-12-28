<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustActivityTrainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_trainer', function(Blueprint $table){
            $table->string('no_spmk')->nullable();
            $table->date('tgl_spmk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_trainer', function(Blueprint $table){
            $table->dropColumn('no_spmk');
            $table->dropColumn('tgl_spmk');
         });
    }
}
