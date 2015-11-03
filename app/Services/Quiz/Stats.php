<?php


namespace App\Services\Quiz;

use App\Models\Departement\Departement;

/**
 * 		
 */
class Stats
{
    public function __construct()
    {
        # code...
    }

    public function getDepartementActivityQuiz()
    {
        $result = [];
        $departements = Departement::all();

        foreach ($departements as $value) {
            array_push($result, ['label' => $value->name, 'value' => $this->getUserByDpartement($value->id)]);
        }

        return $result;
    }

    public function getUserByDpartement($departement_id)
    {
        return Departement::find($departement_id)->users->count();
    }
}
