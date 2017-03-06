<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class School extends Model
{
        use Notifiable;

    protected $primaryKey = 'school_id';

    protected $fillable = [
        'school_name',
    ];

}

