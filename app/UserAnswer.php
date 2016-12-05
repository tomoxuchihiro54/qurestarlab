<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
  protected $fillable = ['user_id'];
  
  public function user() {
    return $this->belongsTo('App\User');
  }
  
  public function userAnswerDetails() {
    return $this->hasMany('App\UserAnswerDetail');
  }
}
