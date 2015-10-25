<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * Class RouteServiceProvider
 * @package App\Providers
 */
class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		//

		parent::boot($router);

		

		$router->bind('category', function($value)
		{
		    return \App\Models\Quiz\Category\Category::withTrashed()->where('id', $value)->first();
		}); 
		
		$router->bind('cour', function($value)
		{
		    return \App\Models\Quiz\Cour\Cour::withTrashed()->where('id', $value)->first();
		});

		$router->bind('page', function($value)
		{
		    return \App\Models\Quiz\Page\Page::withTrashed()->where('id', $value)->first();
		});

		$router->bind('question', function($value)
		{
		    return \App\Models\Quiz\Question\Question::withTrashed()->where('id', $value)->first();
		});

		$router->bind('answer', function($value)
		{
		    return \App\Models\Quiz\Answer\Answer::withTrashed()->where('id', $value)->first();
		});
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}
}