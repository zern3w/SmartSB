<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\School;
use App\Parents;
use App\Attendance;

class Student extends Model
{
    use Notifiable;

protected $primaryKey = 'student_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'student_firstname', 'student_lastname', 'student_nickname', 'email', 'phone', 'sex', 'school_id', 'parent_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function parent()
    {
        return $this->belongsTo('App\Parents');
    }

    public function attendance()
    {
        return $this->belongsTo('App\Attendance');
    }

        public function driver()
    {
        return $this->belongsTo('App\User', 'driver_id');
    }

}
