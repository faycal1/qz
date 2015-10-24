<?php 

namespace App\Services\Quiz;

use App\Models\Access\User\User ;
/**
* 		
*/
class Stats 
{
	
	function __construct()
	{
		# code...
	}

	public function getUserActivityQuiz ($userID)
	{
		return User::where('id' , $userID)->get();
	}
}