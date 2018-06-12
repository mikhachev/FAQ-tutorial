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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'IndexController@index')->name('index');
Route::get('/index/{id}', 'IndexController@indexTheme')->name('index.theme');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('forbidden_word', 'ForbiddenController');
Route::resource('user', 'UserController', ['except' => ['show']])->middleware('auth');
Route::resource('theme', 'ThemeController', ['except' => ['show']])->middleware('auth');
Route::resource('question', 'QuestionController', ['except' => ['show']]);


Route::get('/question/create_answer/{id}', 'QuestionController@create_answer')->name('question.create_answer')->middleware('auth');
Route::get('/question/answer_delete/{id}', 'QuestionController@answer_delete')->name('question.answer_delete')->middleware('auth');
//Route::post('/question/store_answer/', array('as' => 'question.store_answer/{id}', 'uses' => 'QuestionController@store_answer/{id}'));
//Route::get('/question/create_answer/{id}', 'QuestionController@create_answer')->name('answer.create')->middleware('auth');
Route::get('/question/store_answer/{id}', 'QuestionController@store_answer')->name('question.store_answer')->middleware('auth');


Route::get('/question/theme/{id}', 'QuestionController@indexByTheme')->name('question.index_by_theme')->middleware('auth');

Route::get('/question/hide/{id}', 'QuestionController@hide')->name('question.hide')->middleware('auth');