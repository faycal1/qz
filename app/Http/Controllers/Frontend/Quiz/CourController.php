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

    public function show($slug)
    {
    	$cour = Cour::where('slug', $slug)->get()->first();    	    	
    	return view('frontend.quiz.cours.show' , compact('cour' ) ) ;
    }

    public function showCourPage($slug , $slugp)
    {        

    	$cour = Cour::where('slug', $slug)->get()->first();
    	$page = Page::where('slug', $slugp)->get()->first();
    	    	
    	return view('frontend.quiz.cours.showPage' , compact('cour' , 'page' ) ) ;
    }

    public function showCourQuiz($slug ,  $slugq)
    {        
    	$cour = Cour::where('slug', $slug)->get()->first();
    	$question = Question::where('slug', $slugq)->get()->first();
    	    	
    	return view('frontend.quiz.cours.showQuiz' , compact('cour' ,  'question') ) ;
    }
}
