<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Question;

class QuestionController extends Controller
{
    //
    public function getOnce($id){
        $obj = Question::with('answers')->where('id',$id)->get();
        return Helper::ApiResponse($obj, $obj?'success':'fail');
    }

    public function getAll(){
        $objs = Question::with('answers')->simplePaginate(20);
        return Helper::ApiResponse($objs, $objs?'success':'fail');
    }

    public function create(Request $rq){
        $data = $rq->all();

        $validator = Validator::make($data, [
            'question_type_id' => 'required|numeric|exists:question_types,id',
            'package_id' => 'bail|nullable|numeric|exists:questions_packages,id',
            'content' => 'required',
        ]);

        if(!$validator->fails()){
            $t = Question::create($data);
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
            'id' => 'required|numeric|exists:questions,id',
            'question_type_id' => 'numeric|exists:question_types,id',
            'package_id' => 'bail|nullable|numeric|exists:questions_packages,id', //TODO: CHECK WHEN TABLE DOANVAN CREATED
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
            'id' => 'required|exists:questions,id',
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

    public static function getByType($type){
        $objs = Question::with('answers')->where('question_type_id',$type)->simplePaginate(20);
        return Helper::ApiResponse($objs,$objs?'success':'fail');
    }

}
