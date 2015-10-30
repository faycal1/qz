<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Quiz\Stats ;
use App\Models\Access\User\User ;
use App\Models\Quiz\Cour\Cour;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller {

	/**
	 * @return \Illuminate\View\View
	 */
	public function index()
	{

			
		//$stat = Cour::findOrFail(1);
		//return view('backend.dashboard' , compact('stat'));

		return view('backend.dashboard' , compact('stat'));

	}

	function Chart()
	{
		$json =[
			    "chart"=> [
			        "caption"=> "Monthly revenue for last year",
			        "subCaption"=> "Harrys SuperMart",
			        "xAxisName"=> "Month",
			        "yAxisName"=> "Revenues (In USD)",
			        "numberPrefix"=> "$",
			        "theme"=> "fint"
			    ],
			    "data"=> [
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
			];
		return response()->json($json); 
	}
}