<?php

use App\Models\Exposition;
use Illuminate\Database\Seeder;

class ExhibitCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ExhibitCategory::class, 3)->create();
    }
}