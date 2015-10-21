<?php

namespace App\Models\Quiz\Cour;

use DB ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Quiz\Cour\Traits\Attribute\CourAttribute;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Cour extends Model implements SluggableInterface
{
    use CourAttribute ;
    use SluggableTrait;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = ['title' , 'body' ,'category_id' , 'timer' ] ;

    protected $dates = ['deleted_at'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

	
    public function pages()
    {
    	return $this->hasMany('App\Models\Quiz\Page\Page');
    }

    public function questions()
    {
    	return $this->hasMany('App\Models\Quiz\Question\Question');
    }

    public function category()
    {
    	return $this->belongsTo('App\Models\Quiz\Category\Category') ;
    }


    public function users ()
    {
        return $this->belongsToMany('App\Models\Access\User')->withTimestamps(); ;
    }

    public function hasUser($user_id , $cour_id)
    {
        return DB::table('cour_user')->where('user_id', $user_id)->where('cour_id', $cour_id)->first();
    }
}
