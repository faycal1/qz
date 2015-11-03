<?php

namespace  database\seeds\Quiz;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Quiz\Cour\Cour;
use App\Models\Quiz\Question\Question;
use DB;

class CourTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (env('DB_DRIVER') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        DB::table('cours')->truncate();

        $faker = Faker::create();
        $categories = Db::table('categories')->lists('id');
        $departements = Db::table('departements')->lists('id');
        $users = Db::table('users')->lists('id');

                 // $question => ['id'=>$question_id , 'passed'=> 1 | 0]
                 // ['result'=>serilalize(question)  , 'score'=>[0,20,30,40,50,60,80,85,90,90,96,97,98,99,100]
                 //  $user->cours()->sync([$cour_id=>['result'=> Redis::get('quiz') , 'score'=>$request->score]]); 

        foreach (range(1, 10) as $key => $value) {
            $cour = Cour::create([
                            'title' => $faker->sentence(3),
                            'body' => $faker->paragraph(4),
                            'category_id' => $faker->randomElement($categories),
                    ]);

            $questions = $cour->questions->lists('id')->all();
            $cour->departements()->sync($faker->randomElements($departements), 2);
            $question_array = [];
            $score = [0, 20, 30, 40, 50, 60, 80, 85, 90, 90, 96, 97, 98, 99, 100];
            foreach (range(1, 5) as $key => $value) {
                $question = $faker->randomElement($questions);
                array_push($question_array, ['id' => $question, 'passed' => $faker->boolean(50)]);
                $cour->users()->sync([$cour->id => ['result' => serialize($question_array), 'score' => $faker->randomElement($score)]]);

                array_forget($question_array, $question);
            }
        }

        if (env('DB_DRIVER') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
