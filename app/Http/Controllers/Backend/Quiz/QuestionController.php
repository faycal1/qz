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
        return view('backend.quiz.questions.index' )->with('questions', Question::paginate(15)) ;
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
        //dd($request->cour_id) ;
        
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


    /**
     * @return mixed
     */
    public function deleted() 
    {
        $questions = Question::onlyTrashed()->get();
        return view('backend.quiz.questions.deleted' , compact('questions') ) ;
    }

    public function restore(Question $question)
    {
        $question->restore(); 
        return redirect()->route('admin.quiz.question.deleted')->withFlashSuccess('Element restoré avec sucçés');
    }

    public  function forcedelete (Question $question)
    {
        try {
              $question->forceDelete();
              return redirect()->route('admin.quiz.question.deleted')->withFlashSuccess('Element Supprrimé difinitivement avec sucçés');

            } catch ( \Illuminate\Database\QueryException $e) {                
               return redirect()->route('admin.quiz.question.deleted')->withFlashDanger(' vous pouvez pas le supprimer cette question !!!');
            }
    }
}

