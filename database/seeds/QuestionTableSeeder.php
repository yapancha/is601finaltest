<?php

use Illuminate\Database\Seeder;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = App\User::all();
        for($i=0; $i <= 4; $i++){
            $users->each(function ($user){
                $question = factory(App\Question::class)->make();
                $question->user()->associate($user);
                $question->save();
            });
        }
    }
}
