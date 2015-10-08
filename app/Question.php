<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

	protected $fillable = ['title' , 'body' , 'type' ] ;

    public function cour()
    {
    	return $this->belongsTo('App\Cour') ;
    }

    public function answers()
    {
    	return $this->hasMany('App\Answer');
    }
}
