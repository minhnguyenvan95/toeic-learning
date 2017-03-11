<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    //
    protected $fillable = ['name', 'meta'];

    public function questions()
    {
    	return $this->hasMany('App\Question');
    }
}
