<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'student_id', 'driver_id', 'accepted'
    ];

      public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

        public function driver()
    {
        return $this->belongsTo('App\User', 'driver_id');
    }

}
