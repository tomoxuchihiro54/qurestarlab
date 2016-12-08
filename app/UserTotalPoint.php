<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTotalPoint extends Model
{
  
  protected $fillable = ['user_id', 'total_point'];
  
  // userテーブルとリレーション（逆）
  public function user() {
    return $this->belongsTo('App\User');
  }
}
