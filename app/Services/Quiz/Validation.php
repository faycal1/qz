<?php

namespace App\Services\Quiz;

use App\Models\Quiz\Answer\Answer ;

class Validation {

	function OnlyOneTrue( $attribute, $type, $parameters, $validator )
	{
		$question_id = $validator->getData()['question_id'] ;
		
		Answer::CountTrueAnswer($question_id) ;

		if ($type == 1)
			if (Answer::CountTrueAnswer($question_id) == 1)
				return false ;

		return true ;
	}

}