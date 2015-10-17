<?php 

namespace App\Services\Quiz;

use App\Models\Quiz\Cour\Cour ; 
use App\Models\Quiz\Page\Page ;
use App\Models\Quiz\Question\Question ;

class CourService 
{    
    public function lists () {

    	return Cour::paginate(15);
    }

    public function pagelists ($id) {

    	return Page::where('cour_id' , $id)->get();
    }

    public function questionsLists($id)
    {
    	return Question::where('cour_id' , $id)->get();
    }
}