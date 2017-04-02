<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    //
    public function login()
    {
    	if(Auth::user())
    		 return redirect()->intended('admin/dashboard');
    	return view('admin.login',[]);
    }

    public function logout()
    {
    	Auth::logout();
        return redirect('acp');
    }

    public function dashboard(Request $rq)
    {
    	$u = Auth::user();
    	return view('admin.dashboard',['user'=>$u]);
    }

    public function question_packages()
    {
        $qp = \App\QuestionsPackage::all();
        return view('admin.questionpackage',['question_packages' => $qp]);
    }

    public function question_types()
    {
        $t = \App\QuestionType::all();
        return view('admin.questiontype',['question_types' => $t]);
    }

    public function questions()
    {
        $q = \App\Question::all();
        return view('admin.question',['questions' => $q]);
    }

    public function users()
    {
        $u = \App\User::all();
        return view('admin.user',['users'=>$u]);
    }
}
