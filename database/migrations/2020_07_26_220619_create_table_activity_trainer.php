<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableActivityTrainer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_trainer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activity_id')->constrained();
            $table->foreignId('trainer_id')->constrained();
            $table->text('event');
            $table->char('batch')->nullable();
            $table->char('class')->nullable();
            $table->text('subject')->nullable();
            $table->float('volume')->nullable();
            $table->string('place')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->enum('status', ['Terjadwal', 'Valid', 'Selesai'])->default('Terjadwal');
            $table->string('file')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('activity_trainer', function (Blueprint $table) {
            $table->dropForeign(['activity_id']);
            $table->dropForeign(['trainer_id']);
        });
        Schema::dropIfExists('activity_trainer');
    }
}
