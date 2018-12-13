<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $users = App\User::all();
        for($i=0; $i<=2;$i++){

            $users->each(function ($user){
                $question = App\Question::inRandomOrder()->first();
                $answer = App\Answer::inRandomOrder()->first();

                $comment = factory(\App\Comment::class)->make();
                $comment->user()->associate($user);
                $comment->question()->associate($question);
                $comment->answer()->associate($answer);
                $comment->save();
            });
        }
    }
}
