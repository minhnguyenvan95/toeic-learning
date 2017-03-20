<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PracticepageController extends Controller
{
    //
    public function index()
    {
    	$question_types = \App\QuestionType::all();
    	return view('practice',['question_types' => $question_types]);
    }

    public function get_practice($type){
        $isPackage = false;
    	switch ($type) {
            //listening
            case '1' :
                $limit = 10; break;
            case '2' :
                $limit = 30; break;
            case '3' :
            case '4' :
                $limit = 30;
                $isPackage = true;
                break;
            //reading
            case '5' :
                $limit = 40; break;
            case '6' :
                $limit = 12;
                $isPackage = true;
                break;
            case '7' :
                $limit = 48;
                $isPackage = true;
                break;
            default:
                $limit = 0;
    	}


        if($isPackage){
            $data = \App\QuestionsPackage::where('question_type_id',$type)
                ->with('questions')
                ->with('questions.answers')
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        }
        else{
            $data = \App\Question::where('question_type_id',$type)
                    ->with('answers')
                    ->inRandomOrder()
                    ->limit($limit)
                    ->get();
        }
        return Helper::ApiResponse($data, $data?'success':'fail', ['isPackage' => $isPackage]);
    	
    }

    public function practice($type)
    {
        /*
        $data = $this->get_practice($type);
        if($data['status'] == 'success')
            return view('practice',['data' => $data['message'], 'isPackage' => $data['isPackage']]);
        */
        return view('practice',['type' => $type]);
    }
}
