<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Quiz\Stats;
use App\Models\Departement\Departement;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $departements = new Stats();
        $stat = $departements->getTableData();
        return view('backend.dashboard'  )->with('departements' , $stat );
    }

    public function Chart()
    {
        $departements = new Stats();
        $stat = $departements->getDepartementActivityQuiz();

        $json = [
                'chart' => [
                    'caption' => ' *** ',
                    'subCaption' => ' **** ',
                    'xAxisName' => 'Département',
                    'yAxisName' => 'Utilisateur',
                    'numberPrefix' => '',
                    'theme' => 'fint',
                ],
                'data' => $stat,
            ];

        return response()->json($json);
    }

    public function StackedChartCoursUsersByDepartement ()
    {
        $StackedChartCoursUsersByDepartement = new Stats();
        return  response()->json($StackedChartCoursUsersByDepartement->StackedChartCoursUsersByDepartement());
    }

    public function MultiColumnBarByCours($cour)
    {
        $id = $cour->id;
        
        $departements = Departement::whereHas('cours', function ($query) use ($id) 
        {
            return  $query->where('id' , $id) ;
        });

        $stat = new Stats();

        $stats = [];
        foreach ($departements->get() as $departement) {

            $departement_id =$departement->id ;
            $s_f = $stat->getScoreByDepartementByCourList([$id] , $departement_id) ;

            $passed = $departement->cours;

            $stats[$departement->id] = [ 
                        'name'=>$departement->name  ,
                        'users'=> $departement->users->count(),
                        'passed'=> $passed->count(),
                        'succe'=> $s_f['passed'],
                        'failure'  => $s_f['notPassed'],
                        ] ;
        }

       

        return view ('backend.statByCour' )->with('stats' , $stats) ;
         
        //return $users;
    }
}
