<?php

namespace  database\seeds ;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker ;
use App\Models\Quiz\Category\Category;

use DB ;

class CategoryTableSeeder extends Seeder
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
			DB::table('categories')->truncate();

	        $faker = Faker::create();
	    		foreach (range(1,30) as $key => $value ) {

	    		Category::create([
	        		'title'=>$faker->sentence(5),
	        		'body'=>$faker->paragraph(4) 
		        ]);
	    	}

	    	if(env('DB_DRIVER')=='mysql')
				DB::statement('SET FOREIGN_KEY_CHECKS=1;') ;
    }
}
