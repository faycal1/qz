<?php

namespace  database\seeds ;

use DB ;
use Illuminate\Database\Seeder;

class QuizTableSeeder extends Seeder
{
    public function run() {

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');

			 $this->call(\database\seeds\Departement\DepartementTableSeeder::class);
			 $this->call(\database\seeds\Departement\DepartementUserTableSeeder::class);
			  $this->call(\database\seeds\Quiz\CategoryTableSeeder::class);
			  $this->call(\database\seeds\Quiz\CourTableSeeder::class);
			  $this->call(\database\seeds\Quiz\PageTableSeeder::class);
			  $this->call(\database\seeds\Quiz\QuestionTableSeeder::class);
			  $this->call(\database\seeds\Quiz\AnswerTableSeeder::class);


		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
