<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
	public function index(){
		return view('register');
	}

    public function getOnce($id){
    	$obj = User::where('id',$id)->first();
    	return Helper::ApiResponse($obj, $obj?'success':'fail');
    }

    public function getAll(){
        $objs = User::simplePaginate(10);
        return Helper::ApiResponse($objs, $objs?'success':'fail');
    }

    public function create(Request $rq){
    	$data = $rq->all();
    	$validator = $this->validator($data);

    	if(!$validator->fails()){
            $t = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'remember_token' => str_random(10),
                'api_token' => md5(str_random(10)),
               ]);
            if($t)
                return Helper::ApiResponse($t);
            return Helper::ApiResponse('Something went wrong','fail');
        }
	    else
	    	return Helper::ApiResponse($validator->messages()->first(),'fail');
    }

    public static function get_token(Request $rq){
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
                return Helper::ApiResponse(Auth::getUser());
            }
            return Helper::ApiResponse('Email or password is not match our records','fail');
        }
        else
            return Helper::ApiResponse($validator->messages()->first(),'fail');        
    }

    public function update(Request $rq){
        $data = $rq->all();
        
        $conds = [
            'email' => 'bail|required|email|max:50',
            'name' => 'required|max:50',
            'password' => $data["password"] != ""?'min:6|confirmed':'',
        ];

        $validator = Validator::make($data,$conds);

        if(!$validator->fails()){
            $u = Auth::user();
            if($u){
                $u->email = $data['email'];
                $u->name = $data['name'];
                if($data['password'] != "")
                    $u->password = bcrypt($data['password']);

                $u->save();
                return Helper::ApiResponse('Success','success');
            }
            return Helper::ApiResponse('Something went wrong','fail');
        }
        else
            return Helper::ApiResponse($validator->messages()->first(),'fail');
    }

    public function require_login(){
        return Helper::ApiResponse('Not a valid api_token','fail');
    }

    public function require_login_admin()
    {
        return Helper::ApiResponse('Only Admin can access','fail');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|max:50',
            'password' => 'bail|required|min:6|max:50|confirmed',
            'email' => 'bail|required|email|max:50|unique:users',
        ]);
    }
}
