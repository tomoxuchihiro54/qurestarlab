<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  
  protected $fillable = ['title'];
  // question_choicesテーブルとリレーション
  public function questionChoices() {
    return $this->hasMany('App\QuestionChoice');
  }
}
