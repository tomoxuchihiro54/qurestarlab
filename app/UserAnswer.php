<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
  protected $fillable = ['user_id'];
  public function userAnswerDetails() {
    return $this->hasMany('App\UserAnswerDetail');
  }
}
