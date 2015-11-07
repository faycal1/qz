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
                "caption"=> "Taux de Quiz Fait et Pas fait par départmenet",
                "subCaption"=> "---",
                "xAxisname"=> "Departement",
                "yAxisName"=> "Nombre de Quiz",
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

    function getTableData()
    {
        $result = [];
        $departements = Departement::all();

        foreach ($departements as $value) {

            array_push($result, [ 

                    'dep'=>$value->name ,
                    'users'=>$value->users->count() ,
                    'nbr_passed'=>$value->cours()->has('questions')->has('users')->count(),
                    'nbr_non_passed'=>$value->cours()->has('questions')->has('users' , '<' , 1)->count() ,

                    'succes'=>$this->getScoreByDepartementByCourList($value->cours()->lists('cour_id')->all())['passed'] ,
                    'failure'=>$this->getScoreByDepartementByCourList($value->cours()->lists('cour_id')->all())['notPassed']  
                    ]
                );
        }

        return $result;
    }


    public function getCourScoreByDepartement($cour_id)
    {
        $passed =[] ;
        $notPassed =[] ;
        foreach (Cour::find($cour_id)->users as $score )
        {
            //dd($score->pivot->score) ;
                if($score->pivot->score >= '80')
                {
                    array_push($passed, $score->pivot->score) ;
                }else{
                    array_push($notPassed, $score->pivot->score) ;
                }
            
            
        }  

        return ['passed'=>count($passed) , 'notPassed'=>count($notPassed)] ;
    }

    public function getScoreByDepartementByCourList(Array $list)
    {
        $passed =[] ;
        $notPassed =[] ;
        foreach ($list as $value) {
            
            array_push($passed, $this->getCourScoreByDepartement($value)['passed']);
            array_push($notPassed, $this->getCourScoreByDepartement($value)['notPassed']);
        }

        return ['passed'=>array_sum($passed) , 'notPassed'=>array_sum($notPassed)] ;
    }
}
