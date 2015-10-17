<?php

namespace App\Http\Controllers\Frontend\Quiz;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as Req ;

use App\Models\Quiz\Cour\Cour ;
use App\Models\Quiz\Page\Page ;
use App\Models\Quiz\Question\Question ;

class CourController extends Controller
{
    public function index()
    {
    	$cour = Cour::first();
    	return view('frontend.quiz.cours.list' , compact('cour') ) ;
    }

    public function show($slug , $slugp=null)
    {
    	$cour = Cour::where('slug', $slug)->get()->first();
    	$page = null ;    	

    	if(!is_null($slugp))
    	{
    		$page = Page::where('slug', $slugp)->get()->first();
    	}
    	    	
    	return view('frontend.quiz.cours.show' , compact('cour' , 'page' ) ) ;
    }

    public function showCourPage($slug , $slugp=null)
    {
    	$cour = Cour::where('slug', $slug)->get()->first();
    	$page = null ;    	

    	if(!is_null($slugp))
    	{
    		$page = Page::where('slug', $slugp)->get()->first();
    	}
    	    	
    	return view('frontend.quiz.cours.showPage' , compact('cour' , 'page' ) ) ;
    }

    public function showCourQuiz($slug ,  $slugq=null)
    {
    	$cour = Cour::where('slug', $slug)->get()->first();
    	
    	$question = null ;

    	if(!is_null($slugq))
    	{
    		$question = Question::where('slug', $slugq)->get()->first();
    	}    	
    	    	
    	return view('frontend.quiz.cours.showQuiz' , compact('cour' ,  'question') ) ;
    }
}
