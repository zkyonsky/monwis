<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterActivityTrainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_trainer', function (Blueprint $table) {
            $table->dropColumn(['event', 'batch', 'class', 'subject', 'volume', 
                                'place', 'start', 'end', 'status', 'file', 'created_by', 
                                'updated_by','deleted_by', 'created_at', 'updated_at', 'deleted_at',
                              ]);
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
