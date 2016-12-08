<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\QuestionChoice;
use App\UserAnswer;
use App\UserAnswerDetail;
use App\UserTotalPoint;
use DB;

class ResultsController extends Controller
{
  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // 全体の結果を表示
    public function display_result()
    {
      // questionsテーブルの情報をすべて取得
      $questions = Question::all();
      
      // 最新のID指定でuser_answerテーブルの情報取得
      $u_ans = UserAnswer::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->limit(1)->first();
      
      //
      $u_ans_det = UserAnswerDetail::with('question')->where('user_answer_id', $u_ans->id)
                      ->where('correct_flag', '=', 1)->get();
      
      try {
        $data = UserTotalPoint::where('user_answer_id', $u_ans->id)->first();
        if (!$data) {
          // user_total_pointsテーブルに得点を登録する宣言
        $u_total_p = new UserTotalPoint();
        //　ユーザーID
        $u_total_p->user_id = $u_ans->user_id;
        // アンサーID
        $u_total_p->user_answer_id = $u_ans->id;
        // 得点
        $count = 0;
        foreach ($u_ans_det as $a) {
          $count += $a->question->point;
        }
        $u_total_p->total_point = $count;
        // 登録
        $u_total_p->save();
          return redirect('/question/result');
        }
      } catch (Exception $ex) {
         Session::flash('message', 'データベースエラー');
      }
      
      $count = 0;
      foreach ($u_ans_det as $a) {
        $count += $a->question->point;
      }
      
      $correct_num = $u_ans_det->count();
      
      // 正解した割合
      $u_ans_rate = $correct_num / $questions->count() * 100;
      
      return view('questions.result')
        ->with('questions', $questions)
        ->with('u_ans', $u_ans)
        ->with('count', $count)
        ->with('correct_num', $correct_num)
        ->with('data', $data)
        ->with('u_ans_rate', $u_ans_rate);
    }
    
}

