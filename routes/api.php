<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function (){
	
	Route::get('/require_login', ['as' => 'login', 'uses' => 'UserController@require_login']);

	Route::group(['prefix' => 'user'], function (){	
		Route::post('/create','UserController@create')->middleware('guest');
		Route::post('/get_token', 'UserController@get_token');
		Route::post('/update','UserController@update')->middleware('auth:api');
		Route::group(['middleware' => 'admin'], function(){
			Route::get('/all', 'UserController@getAll');
			Route::get('/{id}', 'UserController@getonce')->where('id','[0-9]+');
		});
	});	

	Route::group(['prefix' => 'questiontype'], function (){
		Route::get('/all', 'QuestionTypeController@getAll');
		Route::get('/{id}', 'QuestionTypeController@getOnce')->where('id','[0-9]+');
		Route::group(['middleware' => 'admin'], function(){
			Route::post('/create','QuestionTypeController@create');
			Route::post('/update','QuestionTypeController@update');
			Route::post('/delete','QuestionTypeController@delete');
		});
		
	});	

	Route::group(['prefix' => 'question'], function(){
		Route::get('/type/{type}', 'QuestionController@getByType')->where('type','[0-9]+'); //Add filter ?
		Route::get('/all', 'QuestionController@getAll');
		Route::get('/{id}', 'QuestionController@getOnce')->where('id','[0-9]+');
		Route::group(['middleware' => 'admin'], function(){
			Route::post('/create','QuestionController@create');
			Route::post('/update','QuestionController@update');
			Route::post('/delete','QuestionController@delete');
		});
	});

	Route::group(['prefix' => 'answer'], function(){
		//Route::get('/type/{type}', 'AnswerController@getByType')->where('type','[0-9]+'); //Add filter ?
		//Route::get('/all', 'AnswerController@getAll');
		Route::get('/{id}', 'AnswerController@getOnce')->where('id','[0-9]+');
		Route::group(['middleware' => 'admin'], function(){
			Route::post('/create','AnswerController@create');
			Route::post('/update','AnswerController@update');
			Route::post('/delete','AnswerController@delete');
		});
	});

	Route::get('/practice/{type}','PracticepageController@get_practice')->where('type','[0-9]+');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



