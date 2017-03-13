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