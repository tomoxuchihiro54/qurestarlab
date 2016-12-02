<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\QuestionChoice;
use App\UserAnswer;
use App\UserAnswerDetail;
use DB;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // 最初の問題を表示
    public function index($id = 1)
    {
      try {
        if ($id = 1) {
          $user_ans = new UserAnswer();
          $user_ans->user_id = 1;
          $user_ans->save();
        }
      } catch (Exception $ex) {
        Session::flash('flash_message', 'データベースエラー');
      }
      // questionテーブルの最初のレコードを取得
      $question = Question::findOrFail($id);
      return view('questions.question')
        ->with('question', $question);
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
        // 現在表示されている問題のIDをもとにquestionsテーブルの情報取得
        $now_question = Question::Where('id', '<', $id)->orderBy('id', 'desc')->limit(1)->first();
        
        // 最新のIDをもとにユーザアンサーテーブルの情報取得
        $new_user_ans = UserAnswer::orderBy('id', 'desc')->limit(1)->first();
        // user_answers_detailsテーブルに情報を登録を宣言
        $user_ans_det = new UserAnswerDetail();        // ユーザIDを１に固定
        // ユーザー解答ID
        $user_ans_det->user_answer_id = $new_user_ans->id;
        // 問題ID
        $user_ans_det->question_id = $now_question->id;
        
        // ラジオボタン送られたIDのもとにquestion_choicesテーブルの情報を取得
        $question_choice = QuestionChoice::where('id', $request->choice_id)->first();
        // 正解フラグ
        $user_ans_det->correct_flag = $question_choice->correct_flag;
        // 選択した選択肢番号
        $user_ans_det ->sort_id = $question_choice->sort;
        // 上記情報をuser_answers_detailsテーブルに情報を登録
        $user_ans_det->save();
        
        // 登録問題数を越えたら結果ページへ
        if ($id > Question::all()->count()) {
          return redirect('/question/result');
        }
        
        // IDをもとにquestionsテーブルの情報取得
        $question = Question::findOrFail($id);
        
      } catch (Exception $ex) {
        Session::flash('flash_message', 'データベースエラー');
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
