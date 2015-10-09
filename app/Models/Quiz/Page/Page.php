<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

	protected $fillable = ['title' , 'body' , 'slug'] ;

    public function cour()
    {
    	return $this->belongsTo('App\Cour') ;
    }
}