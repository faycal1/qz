<?php

namespace App\Services\Quiz;

use DB;
use App\Models\Quiz\Cour\Cour;
use App\Models\Departement\Departement;


class Stats
{    

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

            $departement_id = $value->id ;

            $nbr_passed = $value::departementThatHasCours($departement_id)->cours()->whereHas('users' , function($query) use ($departement_id) {
                        return $query->where('departement_id' , $departement_id) ;
                    }) ;

            $success_failure = $this->getScoreByDepartementByCourList($nbr_passed->lists('cour_id')->all() ,  $departement_id ) ;

           
            array_push($result, [ 
                        'id'=>$value->id ,
                        'dep'=>$value->name ,
                        'users'=>$value->users->count() , 
                        'quiz'=>$value->cours()->has('questions')->count() ,                   
                        'nbr_passed'=> $nbr_passed->count() ,   
                        'nbr_non_passed'=> $value->cours()->count() - $nbr_passed->count()  ,
                        'succes'=>$success_failure['passed'] ,
                        'failure'=>$success_failure['notPassed']  
                    ]
                );
        }        
        return $result;
    }

    public function getCourScoreByDepartement($cour_id , $departement_id)
    {
        $passed =[] ;
        $notPassed =[] ;

        $cours =  Cour::where( 'id' , $cour_id)->with(['users' =>function ($query) use($departement_id) {
                        return $query->where('departement_id' , $departement_id) ;
                    } ])->get() ;

        foreach ($cours->all() as $cour) {  

            $users = $cour->users;           

            foreach ($users as $user) {                
                if($user->pivot->score >= '80')
                {
                    array_push($passed, $user->pivot->score) ;
                }else{
                    array_push($notPassed, $user->pivot->score) ;
                }
            } 
        }                 
        return ['passed'=>count($passed) , 'notPassed'=>count($notPassed)] ;
    }

    public function getScoreByDepartementByCourList(Array $list , $departement_id)
    {
        $passed =[] ;
        $notPassed =[] ;
        foreach ($list as $value) {

            $cours = $this->getCourScoreByDepartement($value , $departement_id) ;
            
            array_push($passed, $cours['passed']);
            array_push($notPassed, $cours['notPassed']);
        } 
        return ['passed'=>array_sum($passed) , 'notPassed'=>array_sum($notPassed)] ;
    }
}
