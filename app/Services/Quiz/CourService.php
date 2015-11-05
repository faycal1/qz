<?php

namespace App\Services\Quiz;

use Auth;
use App\Models\Quiz\Page\Page;
use App\Models\Departement\Departement;
use App\Models\Quiz\Question\Question;

class CourService
{
    public function lists()
    {
        if (!is_null(Auth::user()->departement_id)) {
            $departement_id = Auth::user()->departement_id;
            $departement = Departement::find($departement_id);
            if (count($departement)) {
                return $departement->cours;
            } else {
                return [];
            }
        } else {
            return [];
        }
    }

    public function pagelists($id)
    {
        return Page::where('cour_id', $id)->get();
    }

    public function questionsLists($id)
    {
        return Question::where('cour_id', $id)->get();
    }
}
