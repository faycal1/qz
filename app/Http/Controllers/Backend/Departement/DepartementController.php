<?php

namespace App\Http\Controllers\Backend\Departement;

use Carbon\Carbon ;
use App\Http\Requests;
use Illuminate\Http\Request;
//use App\Models\Quiz\Page\Page ;
use App\Http\Controllers\Controller;
use App\Models\Departement\Departement;
use App\Http\Requests\Backend\Departement\CreateDepartementRequest;
use App\Http\Requests\Backend\Departement\UpdateDepartementRequest;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.departement.index' )->with('departements', Departement::paginate(15)); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.departement.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDepartementRequest $request)
    {     
        Departement::create($request->all());
        return redirect()->route('admin.departement.index')->withFlashSuccess('Département crée avec sucçés');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Departement $departement)
    {
        setlocale(LC_TIME, 'fr');
        dd($departement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Departement $departement)
    {        
        return view('backend.departement.edit' , compact('departement') ) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Departement $departement , UpdateDepartementRequest $request ){      

        $category->update($request->all()) ;
        return redirect()->route('admin.departement.index')->withFlashSuccess('Département édité avec sucçés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departement $departement )
    {
         $departement->delete();
         // $departement->cours()->delete();
         return redirect()->route('admin.departement.index')->withFlashSuccess('Département supprimée avec sucçés');;
    }

    /**
     * @return mixed
     */
    public function deleted() {

        $departements = Departement::onlyTrashed()->get();
        return view('backend.departement.deleted' , compact('departements') ) ;
    }

    public function restore(Departement $departement)
    {      
       
        $departement->restore(); 
        //$departement->cours()->restore();        
       
        return redirect()->route('admin.departement.deleted')->withFlashSuccess('Element restoré avec sucçés');;
    }

    public  function forcedelete (Departement $departement)
    {
        try {
              $departement->forceDelete();
              return redirect()->route('admin.departement.deleted')->withFlashSuccess('Element Supprrimé difinitivement avec sucçés');;

            } catch ( \Illuminate\Database\QueryException $e) {                
               return redirect()->route('admin.departement.deleted')->withFlashDanger('Ce Département contiens des Cours ou de utilisateurs , vous pouvez pas le supprimer !!!');
                //var_dump($e->errorInfo );
            }
    }
}
