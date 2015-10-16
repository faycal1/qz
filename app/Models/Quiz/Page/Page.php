<?php

namespace App\Models\Quiz\Page;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quiz\Page\Traits\Attribute\PageAttribute;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Page extends Model implements SluggableInterface
{
    use PageAttribute ;
    use SluggableTrait;
    use SoftDeletes;

    protected $guarded = ['id'];
	protected $fillable = ['title' , 'body' , 'slug' , 'cour_id'] ;

	protected $dates = ['deleted_at'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    public function cour()
    {
    	return $this->belongsTo('App\Models\Quiz\Cour\Cour') ;
    }
}
