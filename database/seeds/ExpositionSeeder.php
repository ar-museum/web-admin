<?php

use Illuminate\Database\Seeder;

class ExpositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        //insert data

        DB::table('expositions')->insert([
            'title' => 'str_random(10)',
            'description' => '@gmail.com',
            'staff_id' => 1
        ]);
    	
    }
}
