<?php

namespace  database\seeds\Departement ;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker ;
use App\Models\Departement\Departement;
use DB ;

class DepartementTableSeeder extends Seeder
{
     /* Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');	
			DB::table('departements')->truncate();

        $faker = Faker::create();

    	foreach (range(1,5) as $key => $value ) {

    		Departement::create([        		
        		'name'=>$faker->lastName        		
        		
	        ]);
    	}

    	if(env('DB_DRIVER')=='mysql')
				DB::statement('SET FOREIGN_KEY_CHECKS=1;') ;
    }
}
