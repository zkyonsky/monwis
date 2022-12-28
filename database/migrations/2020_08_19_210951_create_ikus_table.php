<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ikus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained();
            $table->string('tahun');
            $table->float('target');
            $table->float('realisasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->dropForeign(['trainer_id']);
        });
        Schema::dropIfExists('ikus');
    }
}
