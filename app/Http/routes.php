<?php

/**
 * Switch between the included languages.
 */
require __DIR__.'/Routes/Global/Lang.php';

/*
 * Frontend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Frontend'], function () use ($router) {
    require __DIR__.'/Routes/Frontend/Frontend.php';
    require __DIR__.'/Routes/Frontend/Access.php';
});

/*
 * Backend Routes
 * Namespaces indicate folder structure
 */
$router->group(['namespace' => 'Backend'], function () use ($router) {
    $router->group(['prefix' => 'admin', 'middleware' => 'auth'], function () use ($router) {
        /*
         * These routes need view-backend permission (good if you want to allow more than one group in the backend, then limit the backend features by different roles or permissions)
         *
         * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
         */
        $router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function () use ($router) {
            require __DIR__.'/Routes/Backend/Dashboard.php';
            require __DIR__.'/Routes/Backend/Access.php';
        });

        get('jsonChart', 'DashboardController@Chart');
        get('statcked' , 'DashboardController@StackedChartCoursUsersByDepartement');
        get('stats/cour/{cour}' ,'DashboardController@MultiColumnBarByCours');
    });

});

       


$router->group(['middleware' => 'access.routeNeedsPermission:view-backend'], function ($router) {

      Route::get('datatables/users', [ 'uses' => 'Backend\Access\User\UserController@userData', 'as'=> 'datatables.users']);
      require __DIR__.'/Routes/Backend/Quiz/Category.php';


      Route::patch('admin/quiz/cour/{cour}/restore', ['middleware' => 'access.routeNeedsPermission:restore-cour', 'uses' => 'Backend\Quiz\CourController@restore',   'as' => 'admin.quiz.cour.restore']);
      Route::delete('admin/quiz/cour/{cour}/forcedelete', ['middleware' => 'access.routeNeedsPermission:force-delete-cour', 'uses' => 'Backend\Quiz\CourController@forcedelete',   'as' => 'admin.quiz.cour.forcedelete']);
      Route::get('admin/quiz/cour/create', ['middleware' => 'access.routeNeedsPermission:create-cour', 'uses' => 'Backend\Quiz\CourController@create', 'as' => 'admin.quiz.cour.create']);
      Route::post('admin/quiz/cour/store', ['middleware' => 'access.routeNeedsPermission:create-cour', 'uses' => 'Backend\Quiz\CourController@store',  'as' => 'admin.quiz.cour.store']);
      Route::get('admin/quiz/cour/{cour}/edit', ['middleware' => 'access.routeNeedsPermission:edit-cour', 'uses' => 'Backend\Quiz\CourController@edit',   'as' => 'admin.quiz.cour.edit']);
      Route::patch('admin/quiz/cour/{cour}/update', ['middleware' => 'access.routeNeedsPermission:update-cour', 'uses' => 'Backend\Quiz\CourController@update',   'as' => 'admin.quiz.cour.update']);
      Route::delete('admin/quiz/cour/{cour}/destroy', ['middleware' => 'access.routeNeedsPermission:destroy-cour', 'uses' => 'Backend\Quiz\CourController@destroy',   'as' => 'admin.quiz.cour.destroy']);
      Route::get('admin/quiz/cour/deleted', ['middleware' => 'access.routeNeedsPermission:view-deleted-cour', 'uses' => 'Backend\Quiz\CourController@deleted',   'as' => 'admin.quiz.cour.deleted']);
      Route::get('datatables/cour', [ 'uses' => 'Backend\Quiz\CourController@courData', 'as'=> 'datatables.cour']);
      Route::get('cour/list' , [ 'uses' => 'Backend\Quiz\CourController@getCourHasQuestions' , 'as'=> 'cour.list']) ;
      Route::resource('admin/quiz/cour', 'Backend\Quiz\CourController', ['only' => ['index', 'show']]);

      Route::patch('admin/quiz/page/{page}/restore', ['middleware' => 'access.routeNeedsPermission:restore-page', 'uses' => 'Backend\Quiz\PageController@restore',   'as' => 'admin.quiz.page.restore']);
      Route::delete('admin/quiz/page/{page}/forcedelete', ['middleware' => 'access.routeNeedsPermission:force-delete-page', 'uses' => 'Backend\Quiz\PageController@forcedelete',   'as' => 'admin.quiz.page.forcedelete']);
      Route::get('admin/quiz/page/create', ['middleware' => 'access.routeNeedsPermission:create-page', 'uses' => 'Backend\Quiz\PageController@create', 'as' => 'admin.quiz.page.create']);
      Route::post('admin/quiz/page/store', ['middleware' => 'access.routeNeedsPermission:create-page', 'uses' => 'Backend\Quiz\PageController@store',  'as' => 'admin.quiz.page.store']);
      Route::get('admin/quiz/page/{page}/edit', ['middleware' => 'access.routeNeedsPermission:edit-page', 'uses' => 'Backend\Quiz\PageController@edit',   'as' => 'admin.quiz.page.edit']);
      Route::patch('admin/quiz/page/{page}/update', ['middleware' => 'access.routeNeedsPermission:update-page', 'uses' => 'Backend\Quiz\PageController@update',   'as' => 'admin.quiz.page.update']);
      Route::delete('admin/quiz/page/{page}/destroy', ['middleware' => 'access.routeNeedsPermission:destroy-page', 'uses' => 'Backend\Quiz\PageController@destroy',   'as' => 'admin.quiz.page.destroy']);
      Route::get('admin/quiz/page/deleted', ['middleware' => 'access.routeNeedsPermission:view-deleted-page', 'uses' => 'Backend\Quiz\PageController@deleted',   'as' => 'admin.quiz.page.deleted']);
      Route::get('datatables/page', [ 'uses' => 'Backend\Quiz\PageController@pageData', 'as'=> 'datatables.page']);
      Route::resource('admin/quiz/page', 'Backend\Quiz\PageController', ['only' => ['index', 'show']]);

      Route::patch('admin/quiz/question/{question}/restore', ['middleware' => 'access.routeNeedsPermission:restore-question', 'uses' => 'Backend\Quiz\QuestionController@restore',   'as' => 'admin.quiz.question.restore']);
      Route::delete('admin/quiz/question/{question}/forcedelete', ['middleware' => 'access.routeNeedsPermission:force-delete-question', 'uses' => 'Backend\Quiz\QuestionController@forcedelete',   'as' => 'admin.quiz.question.forcedelete']);
      Route::get('admin/quiz/question/create', ['middleware' => 'access.routeNeedsPermission:create-question', 'uses' => 'Backend\Quiz\QuestionController@create', 'as' => 'admin.quiz.question.create']);
      Route::post('admin/quiz/question/store', ['middleware' => 'access.routeNeedsPermission:create-question', 'uses' => 'Backend\Quiz\QuestionController@store',  'as' => 'admin.quiz.question.store']);
      Route::get('admin/quiz/question/{question}/edit', ['middleware' => 'access.routeNeedsPermission:edit-question', 'uses' => 'Backend\Quiz\QuestionController@edit',   'as' => 'admin.quiz.question.edit']);
      Route::patch('admin/quiz/question/{question}/update', ['middleware' => 'access.routeNeedsPermission:update-question', 'uses' => 'Backend\Quiz\QuestionController@update',   'as' => 'admin.quiz.question.update']);
      Route::delete('admin/quiz/question/{question}/destroy', ['middleware' => 'access.routeNeedsPermission:destroy-question', 'uses' => 'Backend\Quiz\QuestionController@destroy',   'as' => 'admin.quiz.question.destroy']);
      Route::get('admin/quiz/question/deleted', ['middleware' => 'access.routeNeedsPermission:view-deleted-question', 'uses' => 'Backend\Quiz\QuestionController@deleted',   'as' => 'admin.quiz.question.deleted']);
      Route::get('datatables/question', [ 'uses' => 'Backend\Quiz\QuestionController@questionData', 'as'=> 'datatables.question']);
      Route::resource('admin/quiz/question', 'Backend\Quiz\QuestionController', ['only' => ['index', 'show']]);

      Route::patch('admin/quiz/answer/{answer}/restore', ['middleware' => 'access.routeNeedsPermission:restore-answer', 'uses' => 'Backend\Quiz\AnswerController@restore',   'as' => 'admin.quiz.answer.restore']);
      Route::delete('admin/quiz/answer/{answer}/forcedelete', ['middleware' => 'access.routeNeedsPermission:force-delete-answer', 'uses' => 'Backend\Quiz\AnswerController@forcedelete',   'as' => 'admin.quiz.answer.forcedelete']);
      Route::get('admin/quiz/answer/create', ['middleware' => 'access.routeNeedsPermission:create-answer', 'uses' => 'Backend\Quiz\AnswerController@create', 'as' => 'admin.quiz.answer.create']);
      Route::post('admin/quiz/answer/store', ['middleware' => 'access.routeNeedsPermission:create-answer', 'uses' => 'Backend\Quiz\AnswerController@store',  'as' => 'admin.quiz.answer.store']);
      Route::get('admin/quiz/answer/{answer}/edit', ['middleware' => 'access.routeNeedsPermission:edit-answer', 'uses' => 'Backend\Quiz\AnswerController@edit',   'as' => 'admin.quiz.answer.edit']);
      Route::patch('admin/quiz/answer/{answer}/update', ['middleware' => 'access.routeNeedsPermission:update-answer', 'uses' => 'Backend\Quiz\AnswerController@update',   'as' => 'admin.quiz.answer.update']);
      Route::delete('admin/quiz/answer/{answer}/destroy', ['middleware' => 'access.routeNeedsPermission:destroy-answer', 'uses' => 'Backend\Quiz\AnswerController@destroy',   'as' => 'admin.quiz.answer.destroy']);
      Route::get('admin/quiz/answer/deleted', ['middleware' => 'access.routeNeedsPermission:view-deleted-answer', 'uses' => 'Backend\Quiz\AnswerController@deleted',   'as' => 'admin.quiz.answer.deleted']);
      Route::get('datatables/answer', [ 'uses' => 'Backend\Quiz\AnswerController@answerData', 'as'=> 'datatables.answer']);
      Route::resource('admin/quiz/answer', 'Backend\Quiz\AnswerController', ['only' => ['index', 'show']]);

      Route::patch('admin/departement/{departement}/restore', ['middleware' => 'access.routeNeedsPermission:restore-departement', 'uses' => 'Backend\Departement\DepartementController@restore',   'as' => 'admin.departement.restore']);
      Route::delete('admin/departement/{departement}/forcedelete', ['middleware' => 'access.routeNeedsPermission:force-delete-departement', 'uses' => 'Backend\Departement\DepartementController@forcedelete',   'as' => 'admin.departement.forcedelete']);
      Route::get('admin/departement/create', ['middleware' => 'access.routeNeedsPermission:create-departement', 'uses' => 'Backend\Departement\DepartementController@create', 'as' => 'admin.departement.create']);
      Route::post('admin/departement/store', ['middleware' => 'access.routeNeedsPermission:create-departement', 'uses' => 'Backend\Departement\DepartementController@store',  'as' => 'admin.departement.store']);
      Route::get('admin/departement/{departement}/edit', ['middleware' => 'access.routeNeedsPermission:edit-departement', 'uses' => 'Backend\Departement\DepartementController@edit',   'as' => 'admin.departement.edit']);
      Route::patch('admin/departement/{departement}/update', ['middleware' => 'access.routeNeedsPermission:update-departement', 'uses' => 'Backend\Departement\DepartementController@update',   'as' => 'admin.departement.update']);
      Route::delete('admin/departement/{departement}/destroy', ['middleware' => 'access.routeNeedsPermission:destroy-departement', 'uses' => 'Backend\Departement\DepartementController@destroy',   'as' => 'admin.departement.destroy']);
      Route::get('admin/departement/deleted', ['middleware' => 'access.routeNeedsPermission:view-deleted-departement', 'uses' => 'Backend\Departement\DepartementController@deleted',   'as' => 'admin.departement.deleted']);
      Route::resource('admin/departement', 'Backend\Departement\DepartementController', ['only' => ['index', 'show']]);

      Route::get('admin/media/list', ['as' => 'admin.media.list', 'uses' => 'Backend\Media\MediaController@getList']);
      Route::get('admin/media', ['as' => 'admin.media', 'uses' => 'Backend\Media\MediaController@getUpload']);
      Route::post('admin/media/upload', ['as' => 'admin.media.upload', 'uses' => 'Backend\Media\MediaController@postUpload']);
      Route::post('admin/media/delete', ['as' => 'admin.media.remove', 'uses' => 'Backend\Media\MediaController@deleteUpload']);

      //video
      Route::get('admin/media/list/video', ['as' => 'admin.media.list.video', 'uses' => 'Backend\Media\MediaController@getListVideo']);
      Route::get('admin/media/video', ['as' => 'admin.media.video', 'uses' => 'Backend\Media\MediaController@getUploadVideo']);
      Route::post('admin/media/upload/video', ['as' => 'admin.media.upload.video', 'uses' => 'Backend\Media\MediaController@postUploadVideo']);
      Route::post('admin/media/delete/video', ['as' => 'admin.media.remove.video', 'uses' => 'Backend\Media\MediaController@deleteUploadVideo']);

});

$router->group(['middleware' => 'access.routeNeedsPermission:view-frontend'], function ($router) {
    Route::get('cours', ['middleware' => 'access.routeNeedsPermission:view-cours', 'uses' => 'Frontend\Quiz\CourController@index',   'as' => 'cours']);
    Route::get('cour/{slug}', ['middleware' => ['access.routeNeedsPermission:view-cours', 'routeReadCour'], 'uses' => 'Frontend\Quiz\CourController@show',   'as' => 'cour.show']);
    Route::get('cour/{slug}/quiz', ['middleware' => ['access.routeNeedsPermission:view-cours', 'routeReadCour'], 'uses' => 'Frontend\Quiz\CourController@showCourQuiz',   'as' => 'cour.page']);
    Route::get('cour/{slug}/page/{slugp}', ['middleware' => ['access.routeNeedsPermission:view-cours', 'routeReadCour'], 'uses' => 'Frontend\Quiz\CourController@showCourPage',   'as' => 'cour.quiz']);
    Route::get('pxml/{slug}', ['middleware' => ['access.routeNeedsPermission:view-cours', 'routeReadCour'], 'uses' => 'Frontend\Quiz\CourController@paresXml']);
    Route::post('quiz', 'Frontend\Quiz\CourController@quiz');
});


