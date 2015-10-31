<?php

namespace App\Http\Controllers\Backend\Quiz;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Quiz\Cour\Cour ;
use App\Http\Controllers\Controller;
use App\Models\Departement\Departement ;
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
        return view('backend.quiz.cours.index' )->with('cours', Cour::paginate(15)) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {            
        $departements = [''=>'Choisissez un Département'] + Departement::lists('name' , 'id')->all() ;
        $categories = [''=>'Choisissez une catégorie'] + Category::lists('title','id')->all();
        return view('backend.quiz.cours.create' , compact('categories' , 'departements') ) ;
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
        $cour = Cour::create($request->all());
        $cour->departements()->sync($request->departement_id) ;
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
        $departements = [''=>'Choisissez un Département'] + Departement::lists('name' , 'id')->all() ;
        $categories = Category::lists('title','id');
        $DepartementsToDisplay = $cour->selectedDepartement($cour->departements->toArray()) ;
        return view('backend.quiz.cours.edit' , compact('cour' , 'categories' , 'departements' , 'DepartementsToDisplay') ) ;
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
        $cour->departements()->sync($request->departement_id) ;
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
         $cour->questions()->delete();
         return redirect()->route('admin.quiz.cour.index')->withFlashSuccess('Cour supprimée avec sucçés');;
    }


    /**
     * @return mixed
     */
    public function deleted() 
    {
        $cours = Cour::onlyTrashed()->get();
        return view('backend.quiz.cours.deleted' , compact('cours') ) ;
    }

    public function restore(Cour $cour)
    {
        $cour->restore(); 
        $cour->pages()->restore(); 
        $cour->questions()->restore(); 
        return redirect()->route('admin.quiz.cour.deleted')->withFlashSuccess('Element restoré avec sucçés');
    }

    public  function forcedelete (Cour $cour)
    {
        try {
              $cour->forceDelete();
              return redirect()->route('admin.quiz.cour.deleted')->withFlashSuccess('Element Supprrimé difinitivement avec sucçés');

            } catch ( \Illuminate\Database\QueryException $e) {                
               return redirect()->route('admin.quiz.cour.deleted')->withFlashDanger('Ce Cour contiens des pages , vous pouvez pas le supprimer !!!');
            }
    }
}
