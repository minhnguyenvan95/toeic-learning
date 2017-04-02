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

Route::get('/', 'HomepageController@index');

Route::get('/register', function(){
	return View::make('register');
});

Route::get('/login', function(){
	return View::make('login');
})->middleware('guest');

Route::get('/logout','HomepageController@logout');
Route::post('/login', 'HomepageController@login');

Route::get('dashboard','HomepageController@dashboard');
Route::get('courses','HomepageController@courses');
Route::get('posts','HomepageController@posts');

Route::get('/practice', 'PracticepageController@index');
Route::get('/practice/{id}', 'PracticepageController@practice')->where('id','[0-9]+');

Route::get('acp','AdminPageController@login');
Route::group(['prefix' => 'acp','middleware' => 'admin'],function(){
	Route::get('/logout','AdminPageController@logout');
	Route::get('dashboard','AdminPageController@dashboard');
	Route::get('question_packages','AdminPageController@question_packages');
	Route::get('question_types','AdminPageController@question_types');
	Route::get('questions','AdminPageController@questions');
	Route::get('users','AdminPageController@users');
});