<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('driver_id');
            $table->integer('student_id');
            $table->text('comment');
            $table->integer('rating');
            $table->boolean('approved')->default('1');
            $table->boolean('spam')->default('1');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('reviews');
    }
}
