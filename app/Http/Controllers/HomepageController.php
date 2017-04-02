<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomepageController extends Controller
{
    //
    public function index()
    {
    	$latest_courses = \App\Question::latest()->limit(4)->get();
    	$new_students = \App\User::latest()->limit(4)->get();
    	$best_students = \App\User::orderby('balance','desc')->limit(6)->get();
        $new_post = \App\Post::latest()->limit(4)->get();
    	return view('homepage',[
    			'latest_courses' => $latest_courses, 
    			'new_students' => $new_students, 
    			'best_students' => $best_students,
                'new_post' => $new_post,
    			]);
    }

    public function login(Request $rq)
    {
        return UserController::get_token($rq);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function dashboard()
    {
        $u = Auth::user();
        return view('dashboard',['user' => $u]);
    }

    public function courses(Request $rq)
    {
        $question_type = \App\QuestionType::all();
        return view('courses',['question_type' => $question_type]);
    }

    public function posts()
    {
        $posts = \App\Post::limit(4)->get();
        $first = $posts->first();
        return view('post',['posts' => $posts,'first' => $first]);
    }
}
