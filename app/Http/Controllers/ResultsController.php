<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\QuestionChoice;
use App\UserAnswer;
use App\UserAnswerDetail;
use DB;

class ResultsController extends Controller
{
    // 全体の結果を表示
    public function display_result()
    {
      // questionsテーブルの情報をすべて取得
      $questions = Question::all();
      
      // 最新のID指定でuser_answerテーブルの情報取得
      $u_ans = UserAnswer::orderBy('id', 'desc')->limit(1)->first();
      
      // 正解した問題数
      $correct_num = UserAnswerDetail::where('user_answer_id', $u_ans->id)
                      ->where('correct_flag', '=', 1)->count();
      
      // 正解した割合
      $u_ans_rate = $correct_num / $questions->count() * 100;
      
      return view('questions.result')
        ->with('questions', $questions)
        ->with('u_ans', $u_ans)
        ->with('correct_num', $correct_num)
        ->with('u_ans_rate', $u_ans_rate);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        //
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
