<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('driver_id');
        $table->integer('student_id');
        $table->boolean('accepted')->default('0');
        $table->timestamps();
        });
    }

    public function down()
    {
         Schema::drop('services');
    }
}
