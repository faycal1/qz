<?php

namespace App\Http\Controllers\Backend\Quiz;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Quiz\Cour\Cour ;
use App\Http\Controllers\Controller;
use App\Models\Quiz\Category\Category as Category;
use App\Http\Requests\Backend\Quiz\Cour\CreateCourRequest;
use App\Http\Requests\Backend\Quiz\Cour\UpdateCourRequest;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.quiz.cours.index' )->with('cours', Cour::all()) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {            
        $categories = [''=>'Choisissez une catégorie'] + Category::lists('title','id')->all();
        return view('backend.quiz.cours.create' , compact('categories') ) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCourRequest $request)
    {
        //dd($request->all());
        Cour::create($request->all());
        return redirect()->route('admin.quiz.cour.index')->withFlashSuccess('Cour crée avec sucçés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cour $cour)
    {
        setlocale(LC_TIME, 'fr');       
        return view('backend.quiz.cours.show' , compact('cour') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cour $cour)
    {
        $categories = Category::lists('title','id');
        return view('backend.quiz.cours.edit' , compact('cour' , 'categories') ) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Cour $cour ,UpdateCourRequest $request)
    {
        $cour->update($request->all());
        return redirect()->route('admin.quiz.cour.index')->withFlashSuccess('Cour edité avec sucçés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cour $cour)
    {
        $cour->delete();
         $cour->pages()->delete();
         return redirect()->route('admin.quiz.cour.index')->withFlashSuccess('Cour supprimée avec sucçés');;
    }
}
