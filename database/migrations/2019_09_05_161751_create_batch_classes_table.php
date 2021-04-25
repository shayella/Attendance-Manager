<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('batchno');
            $table->string('time');
            $table->string('dayofweek');
            $table->unsignedBigInteger('tutor_id');
            $table->timestamps();
            $table->foreign('tutor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batch_classes');
    }
}
