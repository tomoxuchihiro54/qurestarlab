<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAnswerDetail extends Model
{
  protected $fillable = ['user_answer_id', 'question_id', 'correct_flag'];
  
  // user_answerテーブルとリレーション（逆）
  public function userAnswer() {
    return $this->belongsTo('App\UserAnswer');
  }
  // question_choecesテーブルとリレーション（逆）
  public function questionChoice() {
    return $this->belongsTo('App\QuestionChoice');
  }
}
