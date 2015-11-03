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
        return view('backend.dashboard');
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
}

/*
[
                    [
                        "label"=> "Jan",
                        "value"=> "420000"
                    ],
                    [
                        "label"=> "Feb",
                        "value"=> "810000"
                    ],
                    [
                        "label"=> "Mar",
                        "value"=> "720000"
                    ],
                    [
                        "label"=> "Apr",
                        "value"=> "550000"
                    ],
                    [
                        "label"=> "May",
                        "value"=> "910000"
                    ],
                    [
                        "label"=> "Jun",
                        "value"=> "510000"
                    ],
                    [
                        "label"=> "Jul",
                        "value"=> "680000"
                    ],
                    [
                        "label"=> "Aug",
                        "value"=> "620000"
                    ],
                    [
                        "label"=> "Sep",
                        "value"=> "610000"
                    ],
                    [
                        "label"=> "Oct",
                        "value"=> "490000"
                    ],
                    [
                        "label"=> "Nov",
                        "value"=> "900000"
                    ],
                    [
                        "label"=> "Dec",
                        "value"=> "730000"
                    ]
                ]
*/
