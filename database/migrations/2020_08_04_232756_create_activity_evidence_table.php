<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityEvidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('activity_evidence', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('activity_id')->constrained();
        //     $table->foreignId('evidence_id')->constrained();
        //     $table->string('file')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::create('activity_evidence', function (Blueprint $table) {
        //     $table->dropForeign(['activity_id']);
        //     $table->dropForeign(['evidence_id']);
        // });
        // Schema::dropIfExists('activity_evidence');
    }
}
