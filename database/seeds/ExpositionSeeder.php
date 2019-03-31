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
            'title' => 'Carti Mihai Eminescu',
            'description' => 'Cea mai veche carte',
            'staff_id' => 1
        ]);
    	
    }
}
