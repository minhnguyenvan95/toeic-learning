<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionsPackage extends Model
{
    //
    protected $fillable = ['question_type_id','content'];

    public function questions()
    {
    	return $this->hasMany('App\Question','package_id','id');
    }

    public function question_type()
    {
    	return $this->belongsTo('App\QuestionType','question_type_id','id');
    }
}
