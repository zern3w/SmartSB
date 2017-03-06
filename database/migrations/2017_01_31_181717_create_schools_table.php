<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolsTable extends Migration
{
    public function up()
    {
     Schema::create('schools', function (Blueprint $table) {
        $table->increments('school_id');
        $table->string('school_name');
    });
 }

 public function down()
 {
     Schema::drop('schools');
 }
}
