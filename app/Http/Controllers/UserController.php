<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
	public function index()
	{
		return view('register');
	}

    public function getOnce($id){
    	$user = User::where('id',$id)->first();
    	return $user;
    }

    public function create(Request $rq){
    	$data = $rq->all();
    	$validator = $this->validator($data);

    	if(!$validator->fails()){
            $t = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'remember_token' => str_random(10)
               ]);
            if($t)
                return $this->buildJSON($t);
            return $this->buildJSON('Something went wrong','fail');
        }
	    else
	    	return $this->buildJSON($validator->messages()->first(),'fail');
    }


    public function login(Request $rq){
        $data = $rq->all();
        $conds = [
            'email' => 'bail|required|email|max:50',
            'password' => 'bail|required|min:6',
        ];
        $validator = Validator::make($data,$conds);

        $credentials = [
            'email' => $rq['email'],
            'password' => $rq['password'],
        ];
        if(!$validator->fails()){
            if(Auth::attempt($credentials)){
                return $this->buildJSON(Auth::getUser());
            }
            return $this->buildJSON('Email or password is not match our records','fail');
        }
        else
            return $this->buildJSON($validator->messages()->first(),'fail');        
    }

    public function update(Request $rq){
        $data = $rq->all();
        $validator = $this->validator($data);

        if(!$validator->fails()){
            return $this->buildJSON('Success','fail');
            /*
            $t = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'remember_token' => str_random(10)
               ]);*/
/*
            if($t)
                return $this->buildJSON($t);
            return $this->buildJSON('Something went wrong','fail');*/
        }
        else
            return $this->buildJSON($validator->messages()->first(),'fail');

    }

    public function require_login(){
        return $this->buildJSON('Not a valid api_token','fail');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|max:50',
            'password' => 'bail|required|min:6|confirmed',
            'email' => 'bail|required|email|max:50|unique:users',
        ]);
    }

    private function buildJSON($data,$status = 'success'){
        return ['status' => $status, 'message' => $data];
    }
}
