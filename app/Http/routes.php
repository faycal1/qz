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

	  Route::patch('admin/quiz/category/{category}/restore'  ,['middleware' => 'access.routeNeedsPermission:restore-category'   , 'uses' =>  'Backend\Quiz\CategoryController@restore' ,   'as' => 'admin.quiz.category.restore' ]) ;
	  Route::delete('admin/quiz/category/{category}/forcedelete'  ,['middleware' => 'access.routeNeedsPermission:force-delete-category'   , 'uses' =>  'Backend\Quiz\CategoryController@forcedelete' ,   'as' => 'admin.quiz.category.forcedelete' ]) ;
	  Route::get('admin/quiz/category/create' ,['middleware' => 'access.routeNeedsPermission:create-category' , 'uses' =>  'Backend\Quiz\CategoryController@create' , 'as' => 'admin.quiz.category.create' ]) ;
	  Route::post('admin/quiz/category/store' ,['middleware' => 'access.routeNeedsPermission:create-category' , 'uses' =>  'Backend\Quiz\CategoryController@store' ,  'as' => 'admin.quiz.category.store' ]) ;
	  Route::get('admin/quiz/category/{category}/edit'  ,['middleware' => 'access.routeNeedsPermission:edit-category'   , 'uses' =>  'Backend\Quiz\CategoryController@edit' ,   'as' => 'admin.quiz.category.edit' ]) ;
	  Route::patch('admin/quiz/category/{category}/update'  ,['middleware' => 'access.routeNeedsPermission:update-category'   , 'uses' =>  'Backend\Quiz\CategoryController@update' ,   'as' => 'admin.quiz.category.update' ]) ;
	  Route::delete('admin/quiz/category/{category}/destroy'  ,['middleware' => 'access.routeNeedsPermission:destroy-category'   , 'uses' =>  'Backend\Quiz\CategoryController@destroy' ,   'as' => 'admin.quiz.category.destroy' ]) ;
	  Route::get('admin/quiz/category/deleted'  ,['middleware' => 'access.routeNeedsPermission:view-deleted-category'   , 'uses' =>  'Backend\Quiz\CategoryController@deleted' ,   'as' => 'admin.quiz.category.deleted' ]) ;
	 
	  Route::resource('admin/quiz/category',      'Backend\Quiz\CategoryController' ,['only' => ['index', 'show']]);

	  Route::patch('admin/quiz/cour/{cour}/restore'  ,['middleware' => 'access.routeNeedsPermission:restore-cour'   , 'uses' =>  'Backend\Quiz\CourController@restore' ,   'as' => 'admin.quiz.cour.restore' ]) ;
	  Route::delete('admin/quiz/cour/{cour}/forcedelete'  ,['middleware' => 'access.routeNeedsPermission:force-delete-cour'   , 'uses' =>  'Backend\Quiz\CourController@forcedelete' ,   'as' => 'admin.quiz.cour.forcedelete' ]) ;
	  Route::get('admin/quiz/cour/create' ,['middleware' => 'access.routeNeedsPermission:create-cour' , 'uses' =>  'Backend\Quiz\CourController@create' , 'as' => 'admin.quiz.cour.create' ]) ;
	  Route::post('admin/quiz/cour/store' ,['middleware' => 'access.routeNeedsPermission:create-cour' , 'uses' =>  'Backend\Quiz\CourController@store' ,  'as' => 'admin.quiz.cour.store' ]) ;
	  Route::get('admin/quiz/cour/{cour}/edit'  ,['middleware' => 'access.routeNeedsPermission:edit-cour'   , 'uses' =>  'Backend\Quiz\CourController@edit' ,   'as' => 'admin.quiz.cour.edit' ]) ;
	  Route::patch('admin/quiz/cour/{cour}/update'  ,['middleware' => 'access.routeNeedsPermission:update-cour'   , 'uses' =>  'Backend\Quiz\CourController@update' ,   'as' => 'admin.quiz.cour.update' ]) ;
	  Route::delete('admin/quiz/cour/{cour}/destroy'  ,['middleware' => 'access.routeNeedsPermission:destroy-cour'   , 'uses' =>  'Backend\Quiz\CourController@destroy' ,   'as' => 'admin.quiz.cour.destroy' ]) ;
	  Route::get('admin/quiz/cour/deleted'  ,['middleware' => 'access.routeNeedsPermission:view-deleted-cour'   , 'uses' =>  'Backend\Quiz\CourController@deleted' ,   'as' => 'admin.quiz.cour.deleted' ]) ; 
	   
	  Route::resource('admin/quiz/cour', 'Backend\Quiz\CourController'     ,['only' => ['index', 'show']]);

	  Route::patch('admin/quiz/page/{page}/restore'  ,['middleware' => 'access.routeNeedsPermission:restore-page'   , 'uses' =>  'Backend\Quiz\PageController@restore' ,   'as' => 'admin.quiz.page.restore' ]) ;
	  Route::delete('admin/quiz/page/{page}/forcedelete'  ,['middleware' => 'access.routeNeedsPermission:force-delete-page'   , 'uses' =>  'Backend\Quiz\PageController@forcedelete' ,   'as' => 'admin.quiz.page.forcedelete' ]) ;
	  Route::get('admin/quiz/page/create' ,['middleware' => 'access.routeNeedsPermission:create-page' , 'uses' =>  'Backend\Quiz\PageController@create' , 'as' => 'admin.quiz.page.create' ]) ;
	  Route::post('admin/quiz/page/store' ,['middleware' => 'access.routeNeedsPermission:create-page' , 'uses' =>  'Backend\Quiz\PageController@store' ,  'as' => 'admin.quiz.page.store' ]) ;
	  Route::get('admin/quiz/page/{page}/edit'  ,['middleware' => 'access.routeNeedsPermission:edit-page'   , 'uses' =>  'Backend\Quiz\PageController@edit' ,   'as' => 'admin.quiz.page.edit' ]) ;
	  Route::patch('admin/quiz/page/{page}/update'  ,['middleware' => 'access.routeNeedsPermission:update-page'   , 'uses' =>  'Backend\Quiz\PageController@update' ,   'as' => 'admin.quiz.page.update' ]) ;
	  Route::delete('admin/quiz/page/{page}/destroy'  ,['middleware' => 'access.routeNeedsPermission:destroy-page'   , 'uses' =>  'Backend\Quiz\PageController@destroy' ,   'as' => 'admin.quiz.page.destroy' ]) ;
	  Route::get('admin/quiz/page/deleted'  ,['middleware' => 'access.routeNeedsPermission:view-deleted-page'   , 'uses' =>  'Backend\Quiz\PageController@deleted' ,   'as' => 'admin.quiz.page.deleted' ]) ; 
	   
	  Route::resource('admin/quiz/page', 'Backend\Quiz\PageController'     ,['only' => ['index', 'show']]);


	  Route::patch('admin/quiz/question/{question}/restore'  ,['middleware' => 'access.routeNeedsPermission:restore-question'   , 'uses' =>  'Backend\Quiz\QuestionController@restore' ,   'as' => 'admin.quiz.question.restore' ]) ;
	  Route::delete('admin/quiz/question/{question}/forcedelete'  ,['middleware' => 'access.routeNeedsPermission:force-delete-question'   , 'uses' =>  'Backend\Quiz\QuestionController@forcedelete' ,   'as' => 'admin.quiz.question.forcedelete' ]) ;
	  Route::get('admin/quiz/question/create' ,['middleware' => 'access.routeNeedsPermission:create-question' , 'uses' =>  'Backend\Quiz\QuestionController@create' , 'as' => 'admin.quiz.question.create' ]) ;
	  Route::post('admin/quiz/question/store' ,['middleware' => 'access.routeNeedsPermission:create-question' , 'uses' =>  'Backend\Quiz\QuestionController@store' ,  'as' => 'admin.quiz.question.store' ]) ;
	  Route::get('admin/quiz/question/{question}/edit'  ,['middleware' => 'access.routeNeedsPermission:edit-question'   , 'uses' =>  'Backend\Quiz\QuestionController@edit' ,   'as' => 'admin.quiz.question.edit' ]) ;
	  Route::patch('admin/quiz/question/{question}/update'  ,['middleware' => 'access.routeNeedsPermission:update-question'   , 'uses' =>  'Backend\Quiz\QuestionController@update' ,   'as' => 'admin.quiz.question.update' ]) ;
	  Route::delete('admin/quiz/question/{question}/destroy'  ,['middleware' => 'access.routeNeedsPermission:destroy-question'   , 'uses' =>  'Backend\Quiz\QuestionController@destroy' ,   'as' => 'admin.quiz.question.destroy' ]) ;
	  Route::get('admin/quiz/question/deleted'  ,['middleware' => 'access.routeNeedsPermission:view-deleted-question'   , 'uses' =>  'Backend\Quiz\QuestionController@deleted' ,   'as' => 'admin.quiz.question.deleted' ]) ; 
	   
	  Route::resource('admin/quiz/question', 'Backend\Quiz\QuestionController'     ,['only' => ['index', 'show']]);
	  
	  //Route::resource('admin/quiz/category/cour/page', 'Backend\Quiz\PageController');
	  //Route::resource('admin/quiz/category/cour/question', 'Backend\Quiz\QuestionController');
	  Route::resource('admin/quiz/answer', 'Backend\Quiz\AnswerController');
});
