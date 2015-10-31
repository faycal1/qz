<?php

namespace App\Models\Quiz\Answer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quiz\Answer\Traits\Attribute\AnswerAttribute;


class Answer extends Model 
{
    use AnswerAttribute ;   
    use SoftDeletes;

	protected $guarded = ['id'];
    protected $fillable = ['title' , 'body' ,'question_id',  'type' ] ;

    protected $dates = ['deleted_at'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];
    public function question()
    {
    	return $this->belongsTo('App\Models\Quiz\Question\Question') ;
    }

    public function scopeCountTrueAnswer ($query , $question_id)
    {
        return $query->where('question_id' , $question_id)->where('type' , 1)->count() ;
    }
}
