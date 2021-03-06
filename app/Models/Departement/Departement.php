<?php

namespace App\Models\Departement;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Departement\Traits\Attribute\DepartementAttribute;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use DepartementAttribute;

    use SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = ['name'];

    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany('App\Models\Access\User\User');
    }

    public function cours()
    {
        return $this->belongsToMany('App\Models\Quiz\Cour\Cour');
    }

    // public function usersThrow()
    // {
    //     return $this->hasManyThrough('App\Models\Access\User\User', 'App\Models\Quiz\Cour\Cour');
    // }

    public static function  departementThatHasCours($departement_id)
    {
        return  Departement::find($departement_id);
    }



}
