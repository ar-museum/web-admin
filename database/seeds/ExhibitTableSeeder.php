<?php

use Illuminate\Database\Seeder;

class ExhibitTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('exhibit')->insert([
            'title' => 'Floarea albastra',
            'short_description' => 'So deep!',
            'description' => 'Cea mai splendida poezie ever!',
            'start_year' => '2014',
            'end_year' => '2019',
            'size' => '20x30cm',
            'location' => 'Iasi',
            'author_id' => 1,
            'exposition_id' => 1,
            'staff_id' => 1
        ]);

    }
}
