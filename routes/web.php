<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
  $add_class = 'ly-top-page';
  return view('top')->with('add_class', $add_class);
});

Auth::routes();

// 結果ページの表示
Route::get('/question/result', 'ResultsController@display_result');

// 回数別結果ページの表示
Route::get('/dashboard/answer_history/{id}', 'AnswerHistoriesController@show');

// 最初問題の表示
Route::get('/question/{id?}', 'QuestionsController@index');
Route::any('/question/{id}', 'QuestionsController@store');

// ダッシュボードページの表示
Route::get('/dashboard', 'DashboardsController@index');

// 解答結果履歴ページの表示
Route::get('/dashboard/answer_history', 'AnswerHistoriesController@index');

Route::get('/home', 'HomeController@index');