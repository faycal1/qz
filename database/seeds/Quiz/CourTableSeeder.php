<?php

namespace  database\seeds\Quiz ;


use Illuminate\Database\Seeder;
use Faker\Factory as Faker ;
use App\Models\Quiz\Category\Category;
use App\Models\Quiz\Cour\Cour;
use DB ;

class CourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');	

			DB::table('cours')->truncate();

        $faker = Faker::create();
    	$categories = Db::table('categories')->lists('id') ;

    	foreach (range(1,30) as $key => $value ) {

    		Cour::create([
        		'title'=>$faker->sentence(5),
        		'body'=>$faker->paragraph(4),
        		'category_id'=>$faker->randomElement($categories) 
	        ]);
    	}

    	if(env('DB_DRIVER')=='mysql')
				DB::statement('SET FOREIGN_KEY_CHECKS=1;') ;
    }
}
