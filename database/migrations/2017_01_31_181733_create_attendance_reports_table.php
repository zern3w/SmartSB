<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceReportsTable extends Migration
{
    public function up()
    {
        Schema::create('attendance_reports', function (Blueprint $table) {
        $table->increments('atd_id');
        $table->tinyInteger('atd_status');
        $table->integer('student_id');
        $table->integer('driver_id');
        $table->timestamps();
        });
    }

    public function down()
    {
         Schema::drop('attendance_reports');
    }
}
