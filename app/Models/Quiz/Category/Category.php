<?php

namespace App\Models\Quiz\Category;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz\Category\Traits\Attribute\CategoryAttribute;

class Category extends Model
{
	use CategoryAttribute ;

	protected $guarded = ['id'];
	protected $fillable = ['title' , 'body' , 'slug'];
    public function cours()
    {
    	return $this->hasMany('App\Cour');
    }
}
