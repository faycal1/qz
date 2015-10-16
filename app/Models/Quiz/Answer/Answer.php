<?php

namespace App\Models\Quiz\Answer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quiz\Answer\Traits\Attribute\AnswerAttribute;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Answer extends Model implements SluggableInterface
{
    use AnswerAttribute ;
    use SluggableTrait;
    use SoftDeletes;

	protected $guarded = ['id'];
    protected $fillable = ['title' , 'body' ,'question_id', 'score' ] ;

    protected $dates = ['deleted_at'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];
    public function question()
    {
    	return $this->belongsTo('App\Models\Quiz\Question\Question') ;
    }
}
