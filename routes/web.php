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
  return view('welcome');
});

// 結果ページの表示
Route::get('/question/result', 'ResultsController@display_result');
// 最初問題の表示
Route::get('/question/{id?}', 'QuestionsController@index');
Route::any('/question/{id}', 'QuestionsController@store');

Route::get('/question/result_rate', 'RatesController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');


