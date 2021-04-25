<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rollno');
            $table->string('name');
            $table->string('gender');
            $table->string('email');
            $table->string('phone');
            $table->string('gemail');
            $table->string('gphone');
            $table->unsignedBigInteger('class_id');
            $table->timestamps();
            $table->foreign('class_id')->references('id')->on('batch_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
