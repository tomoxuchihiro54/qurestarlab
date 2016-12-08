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

class ResultTrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // ログインユーザー別にuser_answersテーブルの情報を取得
      $u_answers = UserAnswer::where('user_id', \Auth::user()->id)->get();
      
      // ログインユーザーかつcorrect_flagが1のuser_answer_detailsテーブルの情報取得
      $u_ans_det = UserAnswerDetail::where('user_answer_id', \Auth::user()->id)
                      ->where('correct_flag', '=', 1)->get();
      
      // ログインしているユーザー別にuser_total_pointsテーブルの情報を取得
      $u_total_points = UserTotalPoint::where('user_id', \Auth::user()->id)->get();
      
      return view('histories.resultTrand')
        ->with('u_answers', $u_answers)
        ->with('u_ans_det', $u_ans_det)
        ->with('u_total_points', $u_total_points);
      
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
