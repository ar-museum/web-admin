<?php

use Illuminate\Database\Seeder;

class TriviaTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Trivia::class, 1)->create();
    }
}