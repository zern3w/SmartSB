<?php

namespace App;

use App\Notifications\SbparentResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sbparent extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'parent_id';
    
    protected $fillable = [
    'parent_firstname', 'parent_lastname', 'email', 'phone', 'sex', 'photo', 'password', 'driver_id' 
    ];

    protected $hidden = [
    'password', 'remember_token',
    ];

    
}
