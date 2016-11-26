<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\QuestionChoice;
use App\UserAnswer;
use DB;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 各問題を表示
    public function index($id = 1)
    {
      // questionテーブルの最初のレコードを取得
      $question = Question::where('id', $id)->first();
      return view('questions.question')->with('question', $question);
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
    public function store(Request $request, $id)
    {
      
      try {
        // IDをもとにquestionsテーブルの情報取得
        $question = Question::where('id', $id)->first();
        
        if (!$question) {
          return view('');
        }
        // user_answersテーブルに情報を登録を宣言
        $user_answer = new UserAnswer();        // ユーザIDを１に固定

        $user_answer->user_id = 1;
        // 問題番号
        $user_answer->question_id = $question->id;
        // 解答結果
        $user_answer->correct_flag = $request->correct_flag;
        // user_answerテーブルに情報を登録
        $user_answer->save();
      } catch (Exception $ex) {
        Log::error($ex);
        DB::rollBack();
      }
      
      return view('questions.question')->with('question', $question);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
