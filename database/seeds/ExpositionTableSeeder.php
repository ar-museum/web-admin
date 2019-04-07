<?php

use App\Models\Exposition;
use Illuminate\Database\Seeder;

class ExpositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Exposition::class, 1)->create();
    }
}
