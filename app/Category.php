<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	protected $fillable = ['title' , 'body' , 'slug'];
    public function cours()
    {
    	return $this->hasMany('App\Cour');
    }
}
