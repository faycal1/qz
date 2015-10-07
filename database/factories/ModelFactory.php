<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Carbon\Carbon as Carbon;


/*$factory->define(App\User::class, function (Faker\Generator $faker) {
	return [
		'name' => $faker->name,
		'email' => $faker->email,
		'password' => bcrypt(str_random(10)),
		'remember_token' => str_random(10),
	];
});*/

/*$factory->define(App\Cour::class, function (Faker\Generator $faker) {

	$title = $faker->sentence(4) ;
	return [
		'title' => $title ,
		'slug' => str_slug($title) ,
		'body' => $faker->paragraphs(3 , true),
		'published_at' => Carbon::now(), 
		'user_id' => $faker->randomElement([1,2]),
	];
});*/

$factory->define(App\Category::class, function (Faker\Generator $faker) {

	$title = $faker->sentence(4) ;
	return [
		'title' => $title ,
		'slug' => str_slug($title) ,
		'body' => $faker->paragraphs(3 , true)/*,
		'published_at' => Carbon::now()*/
	];
});


