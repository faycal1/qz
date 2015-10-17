<?php

namespace  database\seeds\Quiz ;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker ;
use App\Models\Quiz\Answer\Answer;
use App\Models\Quiz\Question\Question;
use DB ;

class AnswerTableSeeder extends Seeder
{
     /* Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');	

			DB::table('answers')->truncate();

        $faker = Faker::create();
    	$questions = Db::table('questions')->lists('id') ;

    	foreach (range(1,200) as $key => $value ) {

    		Answer::create([        		
        		'body'=>$faker->paragraph(4),
        		'question_id'=>$faker->randomElement($questions) ,
        		'type'=>$faker->boolean(40) ,
        		
	        ]);
    	}

    	if(env('DB_DRIVER')=='mysql')
				DB::statement('SET FOREIGN_KEY_CHECKS=1;') ;
    }
}
