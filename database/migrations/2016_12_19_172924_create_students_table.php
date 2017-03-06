<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    public function up()
    {
         Schema::create('students', function (Blueprint $table) {
        $table->increments('student_id');
        $table->string('student_firstname');
        $table->string('student_lastname');
        $table->string('student_nickname');
        $table->string('email')->unique();
        $table->string('phone', 10);
        $table->boolean('sex');
        $table->string('photo')->default('default.jpg');
        $table->string('emergency_tel', 10);
        $table->integer('school_id');
        $table->integer('parent_id');
        $table->integer('driver_id')->nullable();
        $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('students');
    }
}
