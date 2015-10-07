<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Cour as Cour;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		//DB::table('cours')->turncate();
		//DB::table('cours')->truncate();

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		$this->call(AccessTableSeeder::class);
		//$this->call(CourTableSeeder::class);

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		Model::reguard();
	}
}