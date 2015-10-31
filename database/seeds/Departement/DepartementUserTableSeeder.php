<?php

namespace  database\seeds\Departement ;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker ;
use App\Models\Access\User\User;
use Carbon\Carbon as Carbon;
use DB ;

class DepartementUserTableSeeder extends Seeder
{
     /* Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		if(env('DB_DRIVER')=='mysql')
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $faker = Faker::create();
        $departement = Db::table('departements')->lists('id') ;

    	foreach (range(1,300) as $key => $value ) {

    		User::create([        		
        		'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('1234'),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => true,
                'departement_id' => $faker->randomElement($departement) ,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()        		
        		
	        ]);
    	}

    	if(env('DB_DRIVER')=='mysql')
				DB::statement('SET FOREIGN_KEY_CHECKS=1;') ;
    }
}
