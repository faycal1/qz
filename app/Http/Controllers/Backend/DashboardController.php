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
		/*$stats = new Stats ();
		$stat = $stats->getUserActivityQuiz(1);*/
		$stat = Cour::findOrFail(1);
		

		foreach ($stat->users as $key => $value) {
			var_dump($value->getrelations()) ;
		}
		exit();
		return view('backend.dashboard' , compact('stat'));
	}
}