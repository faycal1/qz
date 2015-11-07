<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Quiz\Stats;

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

    function StackedChartCoursUsersByDepartement ()
    {
        $StackedChartCoursUsersByDepartement = new Stats();
        return  response()->json($StackedChartCoursUsersByDepartement->StackedChartCoursUsersByDepartement());
    }
}
