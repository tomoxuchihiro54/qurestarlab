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

class AnswerHistoriesController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 過去の結果の履歴の表示
    public function index()
    {
      // ログインユーザー別にuser_answersテーブルの情報を取得
      $u_answers = UserAnswer::where('user_id', \Auth::user()->id)->get();
      
      return view('histories.answerHistory')->with('u_answers', $u_answers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // questionsテーブルの情報をすべて取得
      $questions = Question::all();
      
      $u_ans = UserAnswer::where('id', $id)->first();
      
      // 問題
      $u_ans_det = UserAnswerDetail::where('user_answer_id', $id)
                      ->where('correct_flag', '=', 1)->get();
      
      $count = 0;
      foreach ($u_ans_det as $a) {
        $count += $a->question->point;
      }
      
      $correct_num = $u_ans_det->count();
      
      // 正解した割合
      $u_ans_rate = $correct_num / $questions->count() * 100;
      
      try {
        $data = UserTotalPoint::where('user_answer_id', $id)->first();
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
          return redirect('/dashboard/answer_history/'.$id);
        }
      } catch (Exception $ex) {
         Session::flash('message', 'データベースエラー');
      }
      
      return view('questions.result')
        ->with('questions', $questions)
        ->with('u_ans', $u_ans)
        ->with('count', $count)
        ->with('correct_num', $correct_num)
        ->with('u_ans_rate', $u_ans_rate);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 成績登録
    public function store(Request $request, $id)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
