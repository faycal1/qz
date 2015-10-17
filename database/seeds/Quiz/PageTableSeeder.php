<?php

namespace  database\seeds\Quiz ;


use Illuminate\Database\Seeder;
use Faker\Factory as Faker ;
use App\Models\Quiz\Page\Page;

use DB ;

class PageTableSeeder extends Seeder
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

			DB::table('pages')->truncate();

        $faker = Faker::create();
    	$cours = Db::table('cours')->lists('id') ;

    	foreach (range(1,180) as $key => $value ) {

    		Page::create([
        		'title'=>$faker->sentence(5),
        		'body'=>$faker->paragraph(4),
        		'cour_id'=>$faker->randomElement($cours) 
	        ]);
    	}

    	if(env('DB_DRIVER')=='mysql')
				DB::statement('SET FOREIGN_KEY_CHECKS=1;') ;
    }
}
