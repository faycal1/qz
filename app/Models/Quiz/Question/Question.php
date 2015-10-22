<?php

namespace App\Models\Quiz\Question;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quiz\Question\Traits\Attribute\QuestionAttribute;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Question extends Model implements SluggableInterface
{
    use QuestionAttribute ;
    use SluggableTrait;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = ['title' , 'body' ,'cour_id' , 'type' , 'pass' , 'fail' , 'partial' , 'time' ] ;

    protected $dates = ['deleted_at'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];
	

    public function cour()
    {
    	return $this->belongsTo('App\Models\Quiz\Cour\Cour') ;
    }

    public function answers()
    {
    	return $this->hasMany('App\Models\Quiz\Answer\Answer');
    }

   
}
