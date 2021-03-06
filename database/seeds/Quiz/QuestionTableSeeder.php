<?php

namespace  database\seeds\Quiz ;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker ;
use App\Models\Quiz\Cour\Cour;
use App\Models\Quiz\Question\Question;
use DB ;

class QuestionTableSeeder extends Seeder
{
     /* Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');	

			DB::table('questions')->truncate();

        $faker = Faker::create();
    	$cours = Db::table('cours')->lists('id') ;

    	foreach (range(1,100) as $key => $value ) {
    		Question::create([
        		'title'=>$faker->sentence(3),
        		'body'=>$faker->paragraph(1),
        		'cour_id'=>$faker->randomElement($cours) ,
        		//'type'=>$faker->randomElement(['one'=>'one' , 'multiple'=>'multiple']) ,
                'type'=>$faker->randomElement(['multiple'=>'multiple']) ,
        		'score'=>$faker->numberBetween( 0, 100) ,
                'pass'=>$faker->paragraph(1),
                'fail'=>$faker->paragraph(1),
                'partial'=>$faker->paragraph(1),
	        ]);
    	}

    	if(env('DB_DRIVER')=='mysql')
				DB::statement('SET FOREIGN_KEY_CHECKS=1;') ;
    }
}
