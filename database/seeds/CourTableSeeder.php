<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker ;
// composer require laracasts/testdummy
use App\Cour;

use Carbon\Carbon as Carbon;
use App\Models\Access\User\User as User ;

class CourTableSeeder extends Seeder
{
    public function run()
    {

    	$faker = Faker::create();
    	$user = Db::table('users')->lists('id') ;

    	foreach (range(1,30) as $key => $valu{
    		
    		Cour::create([
        		'title'=>$faker->sentence(5),
        		'body'=>$faker->paragraph(4),
        		'published_at'=>Carbon::now(),
        		'user_id'=>$faker->randomElement($user)
	        ]);

    	}
        
    }
}
