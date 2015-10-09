<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{

    protected $fillable = ['title' , 'body' ] ;
	/**
	 * A Cour Has Many pages
	 * @return \Illuminate\Databse\Eloquent\Relations\HasMany
	 */
    public function pages()
    {
    	return $this->hasMany('App\Page');
    }

    public function questions()
    {
    	return $this->hasMany('App\Question');
    }

    public function category()
    {
    	return $this->belongsTo('App\Category') ;
    }
}
