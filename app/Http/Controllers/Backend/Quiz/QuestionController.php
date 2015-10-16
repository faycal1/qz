<?php

namespace App\Http\Controllers\Backend\Quiz;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Quiz\Cour\Cour ;
use App\Http\Controllers\Controller;
use App\Models\Quiz\Question\Question ;
use App\Http\Requests\Backend\Quiz\Question\CreateQuestionRequest;
use App\Http\Requests\Backend\Quiz\Question\UpdateQuestionRequest;


class QuestionController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.quiz.questions.index' )->with('questions', Question::all()) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {            
        $cours = [''=>'Choisissez un cour'] + Cour::lists('title','id')->all();
        return view('backend.quiz.questions.create' , compact('cours') ) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request)
    {
        
        Question::create($request->all());
        return redirect()->route('admin.quiz.question.index')->withFlashSuccess('Question crée avec sucçés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        setlocale(LC_TIME, 'fr');       
        return view('backend.quiz.questions.show' , compact('question') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        $cours = Cour::lists('title','id');
        return view('backend.quiz.questions.edit' , compact('question' , 'cours') ) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question ,UpdateQuestionRequest $request)
    {
        $question->update($request->all());
        return redirect()->route('admin.quiz.question.index')->withFlashSuccess('Question edité avec sucçés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();         
        return redirect()->route('admin.quiz.question.index')->withFlashSuccess('Question supprimée avec sucçés');;
    }
}

