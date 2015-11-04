<?php


namespace App\Services\Quiz;

use App\Models\Departement\Departement;
use App\Models\Quiz\Cour\Cour;

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
            array_push($result, ['label' => $value->name, 'value' => $this->getUserByDepartement($value->id)]);
        }

        return $result;
    }

    public function getUserByDepartement($departement_id)
    {
        return Departement::find($departement_id)->users->count();
    }

    public function StackedChartCoursUsersByDepartement()
    {
        $category = [];
        $dataset = [];
        $quizsHasUsersByDepartement = [];
        $quizsByDepartement = [];
        $departements = Departement::all();
        foreach ($departements as $value) {
            array_push($category, ["label"=>$value->name]);
            array_push($quizsHasUsersByDepartement, ["value"=>Cour::quizsHasUsersByDepartement($value->id)->count()]);
            array_push($quizsByDepartement, ["value"=>Cour::quizsByDepartement($value->id)->count()]);
        }

        $chart = [
            "chart"=> [
                "caption"=> "Revenue split by product category",
                "subCaption"=> "For current year",
                "xAxisname"=> "Quarter",
                "yAxisName"=> "Revenues (In USD)",
                "showSum"=> "1",
                "numberPrefix"=> "",
                "theme"=> "fint"
            ],
            'categories'=>[
                "category"=>$category 
            ],
            'dataset'=>[
             ['seriesname'=> 'Quiz Par département ' , 'data'=>$quizsByDepartement] ,
             ['seriesname'=> 'Quiz  Passé par au moin un utilisateur par département ' , 'data'=>$quizsHasUsersByDepartement]
               
            ]
        ] ;

        return $chart ;
    }   
}
