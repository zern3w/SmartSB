<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Attendance extends Model
{
     use Notifiable;

    protected $primaryKey = 'atd_id';
    protected $table = 'attendance_reports';

    protected $fillable = [
        'atd_status', 'created_at',
    ];

    public function user()
  {
    return $this->belongsTo('App\User', 'driver_id');
  }
}
