<?php 

namespace App\Services\Quiz;

use App\Models\Quiz\Cour\Cour ; 


class CourService 
{    
    public function lists () {

    	return Cour::paginate(15);
    }
}