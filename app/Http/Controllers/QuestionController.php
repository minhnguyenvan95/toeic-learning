<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Question;

class QuestionController extends Controller
{
    //
    public function getOnce($id){
        $obj = Question::where('id',$id)->get();
        return Helper::ApiResponse($obj,$obj?'success':'fail');
    }

    public function getAll(){
        $objs = Question::simplePaginate(20);
        return Helper::ApiResponse($objs, $objs?'success':'fail');
    }

    public function create(Request $rq){
        $data = $rq->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'meta' => 'required|max:255',
        ]);

        if(!$validator->fails()){
            $t = Question::create([
                'name' => $data['name'],
                'meta' => $data['meta']
               ]);
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
            'id' => 'required|exists:question_types,id',
            'name' => 'max:255',
            'meta' => 'max:255',
        ]);

        if(!$validator->fails()){
            $t = Question::where('id',$data['id'])->update($data);
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
            'id' => 'required|exists:question_types,id',
        ]);

        if(!$validator->fails()){
            $t = Question::where('id',$data['id'])->delete();
            if($t)
                return Helper::ApiResponse($t);
            return Helper::ApiResponse('Something went wrong','fail');
        }
        else
            return Helper::ApiResponse($validator->messages()->first(),'fail');
    }

    public function getByType($type){
        $objs = Question::where('type',$type)->simplePaginate('20');
        return Helper::ApiResponse($objs);
    }

}
