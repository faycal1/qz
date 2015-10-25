<?php namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		
		
		Validator::extend('onlyonetrue', 'App\Services\Quiz\Validation@OnlyOneTrue');
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		if ($this->app->environment() == 'local') {
			//$this->app->register(\Laracasts\Generators\GeneratorsServiceProvider::class);
		}
	}
}
