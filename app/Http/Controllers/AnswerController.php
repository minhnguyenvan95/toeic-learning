<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
class AnswerController extends Controller
{
    //
    public function getOnce($id){
        $obj = Answer::where('id',$id)->first();
        return Helper::ApiResponse($obj,$obj?'success':'fail');
    }

    public function create(Request $rq){
        $data = $rq->all();

        $validator = Validator::make($data, [
            'question_id' => 'required|numeric|exists:questions,id',
            'content' => 'required',
            'check' => 'boolean'
        ]);

        if(!$validator->fails()){
            $t = Answer::create($data);
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
            'id' => 'required|numeric|exists:answers,id',
            'question_id' => 'numeric|exists:questions,id',
            'content' => 'required',
            'check' => 'boolean'
        ]);

        if(!$validator->fails()){
            $t = Answer::where('id',$data['id'])->update($data);
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
            'id' => 'required|exists:answers,id',
        ]);

        if(!$validator->fails()){
            $t = Answer::where('id',$data['id'])->delete();
            if($t)
                return Helper::ApiResponse($t);
            return Helper::ApiResponse('Something went wrong','fail');
        }
        else
            return Helper::ApiResponse($validator->messages()->first(),'fail');
    }

    public function getByQuestion($question_id){
        /*
        $objs = \App\AnswerType::where('id',$type)->first();
        $Answers = $objs->Answers()->get();
        return Helper::ApiResponse($Answers,$Answers?'success':'fail');*/
    }
}
