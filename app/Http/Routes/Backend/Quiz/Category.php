<?php

patch('admin/quiz/category/{category}/restore', ['middleware' => 'access.routeNeedsPermission:restore-category', 'uses' => 'Backend\Quiz\CategoryController@restore',   'as' => 'admin.quiz.category.restore']);
      delete('admin/quiz/category/{category}/forcedelete', ['middleware' => 'access.routeNeedsPermission:force-delete-category', 'uses' => 'Backend\Quiz\CategoryController@forcedelete',   'as' => 'admin.quiz.category.forcedelete']);
      get('admin/quiz/category/create', ['middleware' => 'access.routeNeedsPermission:create-category', 'uses' => 'Backend\Quiz\CategoryController@create', 'as' => 'admin.quiz.category.create']);
      post('admin/quiz/category/store', ['middleware' => 'access.routeNeedsPermission:create-category', 'uses' => 'Backend\Quiz\CategoryController@store',  'as' => 'admin.quiz.category.store']);
      get('admin/quiz/category/{category}/edit', ['middleware' => 'access.routeNeedsPermission:edit-category', 'uses' => 'Backend\Quiz\CategoryController@edit',   'as' => 'admin.quiz.category.edit']);
      patch('admin/quiz/category/{category}/update', ['middleware' => 'access.routeNeedsPermission:update-category', 'uses' => 'Backend\Quiz\CategoryController@update',   'as' => 'admin.quiz.category.update']);
      delete('admin/quiz/category/{category}/destroy', ['middleware' => 'access.routeNeedsPermission:destroy-category', 'uses' => 'Backend\Quiz\CategoryController@destroy',   'as' => 'admin.quiz.category.destroy']);
      get('admin/quiz/category/deleted', ['middleware' => 'access.routeNeedsPermission:view-deleted-category', 'uses' => 'Backend\Quiz\CategoryController@deleted',   'as' => 'admin.quiz.category.deleted']);
      get('datatables/category', [ 'uses' => 'Backend\Quiz\CategoryController@categoryData', 'as'=> 'datatables.category']);
      resource('admin/quiz/category',      'Backend\Quiz\CategoryController', ['only' => ['index', 'show']]);

   ?>