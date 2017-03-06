<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Review extends Model
{
  protected $fillable = [
  'driver_id', 'student_id', 'rating', 'comment', 'approved', 'spam'
  ];

  public function parent()
  {
    return $this->belongsTo('App\Sbparent', 'parent_id');
  }

  public function student()
  {
    return $this->belongsTo('App\Student', 'student_id');
  }

  public function driver()
  {
    return $this->belongsTo('App\User', 'driver_id');
  }

  public function scopeApproved($query)
  {
    return $query->where('approved', true);
  }

  public function scopeSpam($query)
  {
    return $query->where('spam', true);
  }

  public function scopeNotSpam($query)
  {
    return $query->where('spam', false);
  }

  public function getTimeagoAttribute()
  {
    $date = Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
    return $date;
  }

  public function getDayagoAttribute($query)
  {
    $date = Carbon::createFromTimeStamp(strtotime($this->created_at))->diffInDays();
    return $date;
  }

}
