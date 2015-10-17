<?php

namespace App\Http\Controllers\Backend\Quiz;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Quiz\Page\Page ;
use App\Models\Quiz\Cour\Cour ;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Quiz\Page\CreatePageRequest;
use App\Http\Requests\Backend\Quiz\Page\UpdatePageRequest;

class PageController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.quiz.pages.index' )->with('pages', Page::paginate(15)) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {            
        $cours = [''=>'Choisissez un cour'] + Cour::lists('title','id')->all();
        return view('backend.quiz.pages.create' , compact('cours') ) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageRequest $request)
    {
        
        Page::create($request->all());
        return redirect()->route('admin.quiz.page.index')->withFlashSuccess('Page crée avec sucçés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        setlocale(LC_TIME, 'fr');       
        return view('backend.quiz.pages.show' , compact('page') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $cours = Cour::lists('title','id');
        return view('backend.quiz.pages.edit' , compact('page' , 'cours') ) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Page $page ,UpdatePageRequest $request)
    {
        $page->update($request->all());
        return redirect()->route('admin.quiz.page.index')->withFlashSuccess('Page edité avec sucçés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
         //$page->pages()->delete();
         return redirect()->route('admin.quiz.page.index')->withFlashSuccess('Page supprimée avec sucçés');;
    }
}
