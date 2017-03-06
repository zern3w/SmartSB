<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\School;
use App\Sbparent;
use App\Attendance;

class Student extends Model
{
    use Notifiable;

    protected $primaryKey = 'student_id';

    protected $fillable = [
    'student_firstname', 'student_lastname', 'student_nickname', 'email', 'phone', 'sex', 'school_id', 'parent_id',
    ];

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function parent()
    {
        return $this->belongsTo('App\Sbparent', 'parent_id');
    }

    public function driver()
    {
        return $this->belongsTo('App\User', 'driver_id');
    }

}
