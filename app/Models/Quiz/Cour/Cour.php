<?php

namespace App\Models\Quiz\Cour;

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
    protected $fillable = ['title' , 'body' ,'category_id' , 'timer'];
    protected $dates = ['deleted_at'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
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
        return $this->belongsTo('App\Models\Quiz\Category\Category');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\Access\User\User', 'cour_user')->withPivot('score', 'result')->withTimestamps();
    }

    public function departements()
    {
        return $this->belongsToMany('App\Models\Departement\Departement', 'cour_departement');
    }

    public function hasUser($user_id, $cour_id)
    {               
           $questions =0;
            $score = 0;
            $result= '';
            $cour =  Cour::find($cour_id); 
            $questions = $cour->questions->count();

            if(!is_null($cour ->users->first()))
            {
                $first =  $cour ->users->first();
                        if (!is_null($first))
                        {
                                $score =  $first ->pivot->score;
                                $result=  $first ->pivot->result;
                         }
                        
            }
            return ['score'=>$score , 'result' => unserialize($result ) , 'questions'=>$questions] ;       
    }

    public function selectedDepartement(Array $selected)
    {
        $DepartementsToDisplay = [];

        foreach ($selected as $key => $value) {
            array_push($DepartementsToDisplay, $value['id']);
        }

        return $DepartementsToDisplay;
    }

    public static function quizsByDepartement ($departement_id)
    {
        return Cour::has('questions')->whereHas('departements' , function($query) use ($departement_id)
        { 
             $query->where('id', $departement_id);                                                                              
        });
    }

    public static function quizsHasUsersByDepartement ($departement_id)
    {
        return Cour::has('questions')->has('users')->whereHas('departements' , function($query) use ($departement_id)
        { 
             $query->where('id', $departement_id);                                                                              
        });
    }

    public static function quizsHasNotUsersByDepartement ($departement_id)
    {
        return Cour::has('questions')->has('users' , '<', 1)->whereHas('departements' , function($query) use ($departement_id)
        { 
             $query->where('id', $departement_id);                                                                              
        });
    }

    public static function quizsHasUsers ( $cour_id , $user_id)
    {
        return Cour::find($cour_id)->users()->find($user_id); 
    }

    public static function quizHasUsers ( )
    {
        return Cour::has('users'); 
    }

    public static function quizsHasNotUsers ()
    {
        return Cour::has('questions')->has('users' , '<' , 1);
    }
    
}
