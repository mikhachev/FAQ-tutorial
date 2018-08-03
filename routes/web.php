<?php

Auth::routes();

Route::get('/', 'IndexController@index')->name('index');
Route::get('/index/{id}', 'IndexController@indexTheme')->name('index.theme');
Route::resource('user', 'UserController', ['except' => ['show']])->middleware('auth');
Route::resource('theme', 'ThemeController', ['except' => ['show']])->middleware('auth');
Route::resource('question', 'QuestionController', ['except' => ['show']]);


Route::get('/question/create_answer/{id}', 'QuestionController@create_answer')->name('question.create_answer')->middleware('auth');
Route::get('/question/answer_delete/{id}', 'QuestionController@answer_delete')->name('question.answer_delete')->middleware('auth');
Route::get('/question/store_answer/{id}', 'QuestionController@store_answer')->name('question.store_answer')->middleware('auth');
Route::get('/question/theme/{id}', 'QuestionController@indexByTheme')->name('question.index_by_theme')->middleware('auth');
Route::get('/question/hide/{id}', 'QuestionController@hide')->name('question.hide')->middleware('auth');
