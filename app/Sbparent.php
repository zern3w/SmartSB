<?php

namespace App;

use App\Notifications\SbparentResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Sbparent extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'parent_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'parent_firstname', 'parent_lastname', 'email', 'phone', 'sex', 'photo', 'password', 'driver_id' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SbparentResetPassword($token));
    }

}
