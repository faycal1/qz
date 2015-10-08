<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

	protected $fillable = ['body' , 'type' , 'score' ] ;
    public function question()
    {
    	return $this->belongsTo('App\Question') ;
    }
}
