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

class QuestionsController extends Controller
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
    // 最初の問題を表示
    public function index($id = 1)
    {
      try {
        
        if ($id = 1) {
          // ログインユーザーを指定してuser_answersテーブルの情報取得
          $recode = UserAnswer::where('user_id', \Auth::user()->id)->first();
          // user_answersテーブルにデータをインサート
          $user_ans = new UserAnswer();
          $user_ans->user_id = \Auth::user()->id;
          if (!$recode) {
            $user_ans->num_times = 1;
          } else {
            $user_ans->num_times = $recode->max('num_times') + 1;
          }
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
        $new_user_ans = UserAnswer::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->limit(1)->first();
        // user_answers_detailsテーブルに情報を登録を宣言
        $user_ans_det = new UserAnswerDetail();
        // ユーザー解答ID
        $user_ans_det->user_answer_id = $new_user_ans->id;
        // 問題ID
        $user_ans_det->question_id = $now_question->id;
        
        // ラジオボタン送られたIDのもとにquestion_choicesテーブルの情報を取得
        $question_choice = QuestionChoice::where('id', $request->choice_id)->first();
        // 正解フラグ
        $user_ans_det->correct_flag = $question_choice->correct_flag;
        // 選択した選択肢番号
        $user_ans_det->sort_id = $question_choice->sort;
        // 解くまでにかかった時間
        $user_ans_det->time = $request->counter;
        // 上記情報をuser_answers_detailsテーブルに情報を登録
        $user_ans_det->save();
         
        // 登録問題数を越えたら結果ページへ
        if ($id > Question::all()->count()) {
          return response()->json(false);
        }
        // IDをもとにquestionsテーブルの情報取得
        $question = Question::findOrFail($id);
        
      } catch (Exception $ex) {
        Session::flash('message', 'データベースエラー'); 
      }
      
        return view('questions.question')->with('question', $question);
    }
}
