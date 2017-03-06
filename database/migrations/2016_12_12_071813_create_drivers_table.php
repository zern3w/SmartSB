<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    public function up()
    {
       Schema::create('drivers', function (Blueprint $table) {
        $table->increments('driver_id');
        $table->string('driver_firstname');
        $table->string('driver_lastname');
        $table->string('email')->unique();
        $table->string('phone', 10);
        $table->boolean('sex');
        $table->string('platenum', 7)->nullable();
        $table->string('note')->nullable();
        $table->string('photo')->default('default.jpg');
        $table->string('password');
        $table->float('lat')->nullable();
        $table->float('lng')->nullable();
        $table->boolean('availability')->default('1');
        $table->integer('fee')->nullable();
        $table->float('rating_cache')->default('3');
        $table->integer('rating_count')->default('0');
        $table->integer('school_stop_one')->nullable();
        $table->integer('school_stop_two')->nullable();
        $table->integer('school_stop_three')->nullable();
        $table->integer('school_stop_four')->nullable();
        $table->integer('school_stop_five')->nullable();
        $table->rememberToken();
        $table->timestamps();
    });
   }

    public function down()
    {
        Schema::drop('drivers');
    }
}
