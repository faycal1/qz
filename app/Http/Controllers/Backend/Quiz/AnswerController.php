<?php

namespace App\Http\Controllers\Backend\Quiz;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Quiz\Question\Question ;
use App\Http\Controllers\Controller;
use App\Models\Quiz\Answer\Answer ;
use App\Http\Requests\Backend\Quiz\Answer\CreateAnswerRequest;
use App\Http\Requests\Backend\Quiz\Answer\UpdateAnswerRequest;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.quiz.answers.index' )->with('answers', Answer::all()) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {            
        $questions = [''=>'Choisissez une Question'] + Question::lists('title','id')->all();
        return view('backend.quiz.answers.create' , compact('questions') ) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAnswerRequest $request)
    {
        
        Answer::create($request->all());
        return redirect()->route('admin.quiz.answer.index')->withFlashSuccess('Answer crée avec sucçés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        setlocale(LC_TIME, 'fr');       
        return view('backend.quiz.answers.show' , compact('answer') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        $questions = Question::lists('title','id');
        return view('backend.quiz.answers.edit' , compact('answer' , 'questions') ) ;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Answer $answer ,UpdateAnswerRequest $request)
    {
        $answer->update($request->all());
        return redirect()->route('admin.quiz.answer.index')->withFlashSuccess('Answer edité avec sucçés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();         
        return redirect()->route('admin.quiz.answer.index')->withFlashSuccess('Answer supprimée avec sucçés');;
    }
}

