<?php

/**
 * Switch between the included languages
 */
require(__DIR__ . "/Routes/Global/Lang.php");

/**
 * Frontend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Frontend'], function () use ($router)
{
	require(__DIR__ . "/Routes/Frontend/Frontend.php");
	require(__DIR__ . "/Routes/Frontend/Access.php");
});

/**
 * Backend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Backend'], function () use ($router)
{
	$router->group(['prefix' => 'admin', 'middleware' => 'auth'], function () use ($router)
	{
		/**
		 * These routes need view-backend permission (good if you want to allow more than one group in the backend, then limit the backend features by different roles or permissions)
		 *
		 * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
		 */
		$router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router)
		{
			require(__DIR__ . "/Routes/Backend/Dashboard.php");
			require(__DIR__ . "/Routes/Backend/Access.php");
		});
	});
});


$router->group(['middleware' =>'access.routeNeedsPermission:view-backend'] , function($router)
{
	  Route::get('admin/quiz/category/create' ,['middleware' => 'access.routeNeedsPermission:create-category' , 'uses' =>  'Backend\Quiz\CategoryController@create' , 'as' => 'admin.quiz.category.create' ]) ;
	  Route::post('admin/quiz/category/store' ,['middleware' => 'access.routeNeedsPermission:create-category' , 'uses' =>  'Backend\Quiz\CategoryController@store' ,  'as' => 'admin.quiz.category.store' ]) ;
	  Route::get('admin/quiz/category/{category}/edit'  ,['middleware' => 'access.routeNeedsPermission:edit-category'   , 'uses' =>  'Backend\Quiz\CategoryController@edit' ,   'as' => 'admin.quiz.category.edit' ]) ;
	  Route::PATCH('admin/quiz/category/{category}/update'  ,['middleware' => 'access.routeNeedsPermission:update-category'   , 'uses' =>  'Backend\Quiz\CategoryController@update' ,   'as' => 'admin.quiz.category.update' ]) ;
	  Route::delete('admin/quiz/category/{category}/destroy'  ,['middleware' => 'access.routeNeedsPermission:destroy-category'   , 'uses' =>  'Backend\Quiz\CategoryController@destroy' ,   'as' => 'admin.quiz.category.destroy' ]) ;

	  Route::resource('admin/quiz/category', 'Backend\Quiz\CategoryController' ,['except' => ['create', 'store', 'update', 'edit' , 'destroy']]);

	  

	  Route::resource('admin/quiz/category/cour', 'Backend\Quiz\CourController');
	  Route::resource('admin/quiz/category/cour/page', 'Backend\Quiz\PageController');
	  Route::resource('admin/quiz/category/cour/question', 'Backend\Quiz\QuestionController');
	  Route::resource('admin/quiz/category/cour/question/answer', 'Backend\Quiz\AnswerController');
});
