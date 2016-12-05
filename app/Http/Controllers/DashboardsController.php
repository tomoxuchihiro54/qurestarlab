<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Question;
use App\QuestionChoice;
use App\UserAnswer;
use App\UserAnswerDetail;
use DB;

class DashboardsController extends Controller
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
    public function index()
    {
      return view('dashboards.dashboard');
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
      $this->validate($request,[
            'img' => 'required|mimes:jpeg,png,gif',
        ]);
        // アップロード画像を取得
        $image = $request->file('img');

        // 拡張子取得
        $ext = $image->getClientOriginalExtension();

        // ファイル名
        $name = md5(mt_rand().date('Y-m-d H:i:s')).".".$ext;

        // public/imagesに画像を保存する => 場所の情報
        $upload = $image->move('images', $name);
        
        // プロフィール画像の登録
        try {
          $user = User::findOrFail($id=1);
          
          $realpath = realpath('/images');
          
          $old_name = rename($realpath . '/' .$user->img, $realpath . '/' . $user->img . 'bak');
          
          
          
        } catch (Exception $ex) {

        }
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
