<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('unit');
            $table->enum('jabatan', ['Widyaiswara Ahli Pertama', 'Widyaiswara Ahli Muda', 'Widyaiswara Ahli Madya', 'Widyaiswara Ahli Utama']);
            $table->enum('status', ['Widyaiswara', 'Pengajar BPPK', 'Pengajar non BPPK'])->default('Widyaiswara');
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
        Schema::dropIfExists('trainers');
    }
}
