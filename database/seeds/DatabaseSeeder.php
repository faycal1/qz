<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();		

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');

		//$this->call(AccessTableSeeder::class);
		$this->call(\database\seeds\CategoryTableSeeder::class);
		$this->call(\database\seeds\CourTableSeeder::class);
		$this->call(\database\seeds\PageTableSeeder::class);

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=1;');

		Model::reguard();
	}
}