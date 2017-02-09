<?php

namespace App;

use App\School;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'driver_id';
    protected $table = 'drivers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'driver_firstname', 'driver_lastname', 'email', 'phone', 'sex', 'password', 'lat', 'lng'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public function schoolOne()
    {
        return $this->belongsTo('App\School', 'school_stop_one');
    }
    public function schoolTwo()
    {
        return $this->belongsTo('App\School', 'school_stop_two');
    }
    public function schoolThree()
    {
        return $this->belongsTo('App\School', 'school_stop_three');
    }
    public function schoolFour()
    {
        return $this->belongsTo('App\School', 'school_stop_four');
    }
    public function schoolFive()
    {
        return $this->belongsTo('App\School', 'school_stop_five');
    }
    public function friendOfMine()
    {
       return $this->belongsTo('App\User', 'drivers', 'driver_id', 'parent_id' );
   }
   public function friendOf()
   {
       return $this->belongsTo('App\Sbparent', 'parents', 'parent_id', 'driver_id' );
   }
   public function parents()
   {
    return $this->friendOfMine()->wherePivot('accepted', ture)->get()->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'driver_id');
    }
    
    public function recalculateRating()
    {
        $reviews = $this->reviews()->notSpam()->approved();
        $avgRating = $reviews->avg('rating');
        $this->rating_cache = round($avgRating,1);
        $this->rating_count = $reviews->count();
        $this->save();
    }
}
