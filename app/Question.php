<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['question_type_id','package_id','content','choice',];
    public function answers()
    {
    	return $this->hasMany('App\Answer');
    }

    public function questiontype()
    {
    	return $this->belongsTo('App\QuestionType','question_type_id','id');
    }
}
