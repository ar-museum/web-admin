<?php

use App\Models\Exposition;
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

        factory(App\Models\Exposition::class, 2)->create();
    	
    }
}
