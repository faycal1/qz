<?php

namespace App\Models\Quiz\Category;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quiz\Category\Traits\Attribute\CategoryAttribute;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Category extends Model implements SluggableInterface
{
	use CategoryAttribute ;
	use SluggableTrait;

	protected $guarded = ['id'];
	protected $fillable = ['title' , 'body' ];

	protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    public function cours()
    {
    	return $this->hasMany('App\Cour');
    }
}
