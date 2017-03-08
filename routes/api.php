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
	Route::group(['prefix' => 'user'], function (){

		Route::post('/create','UserController@create')->middleware('guest');
		Route::post('/login', 'UserController@login');
		Route::get('/require_login', ['as' => 'login', 'uses' => 'UserController@require_login']);
		Route::post('/update','UserController@update')->middleware('auth:api');
	});	

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



