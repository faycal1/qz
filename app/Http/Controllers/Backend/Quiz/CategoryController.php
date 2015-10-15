<?php

namespace App\Http\Controllers\Backend\Quiz;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Quiz\Category\CreateCategoryRequest;
use App\Http\Requests\Backend\Quiz\Category\UpdateCategoryRequest;
use App\Models\Quiz\Category\Category ;
use Carbon\Carbon as Carbon;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('backend.quiz.categories.index' )->with('categories', Category::all()) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.quiz.categories.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {

       // Category::create(['title'=>$request->input('title') , 'slug'=>str_slug($request->input('title')) ,'body'=>$request->input('body') ]);
       Category::create($request->all());
        return redirect()->route('admin.quiz.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        setlocale(LC_TIME, 'fr');
        // $category = Category::findOrFail($id);
       
        return view('backend.quiz.categories.show' , compact('category') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {      
         
        return view('backend.quiz.categories.edit' , compact('category') ) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Category $category , UpdateCategoryRequest $request )     {
        

        $category->update($request->all()) ;
        return redirect()->route('admin.quiz.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->destroy(1);
    }
}
