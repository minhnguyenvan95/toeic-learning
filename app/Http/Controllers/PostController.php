<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    //
     public function getOnce($id){
        $obj = Post::where('id',$id)->get();
        return Helper::ApiResponse($obj, $obj?'success':'fail');
    }

    public function getAll(){
        $objs = Post::simplePaginate(20);
        return Helper::ApiResponse($objs, $objs?'success':'fail');
    }

    public function create(Request $rq){
        $data = $rq->all();

        $validator = Validator::make($data, [
            'title' => 'required|max:255'
            'content' => 'required',
        ]);

        if(!$validator->fails()){
            $t = Post::create($data);
            if($t)
                return Helper::ApiResponse($t);
            return Helper::ApiResponse('Something went wrong','fail');
        }
        else
            return Helper::ApiResponse($validator->messages()->first(),'fail');
    }

    public function update(Request $rq){
        $data = $rq->all();
        
        $validator = Validator::make($data, [
            'id' => 'required|numeric|exists:posts,id',
            'content' => 'required|max:255',
            'title' => 'required|max:255'
        ]);

        if(!$validator->fails()){
            $t = Post::where('id',$data['id'])->update($data);
            if($t)
                return Helper::ApiResponse($t);
            return Helper::ApiResponse('Something went wrong','fail');
        }
        else
            return Helper::ApiResponse($validator->messages()->first(),'fail');
    }

    public function delete(Request $rq){
        $data = $rq->all();

        $validator = Validator::make($data, [
            'id' => 'required|exists:posts,id',
        ]);

        if(!$validator->fails()){
            $t = Post::where('id',$data['id'])->delete();
            if($t)
                return Helper::ApiResponse($t);
            return Helper::ApiResponse('Something went wrong','fail');
        }
        else
            return Helper::ApiResponse($validator->messages()->first(),'fail');
    }


}
