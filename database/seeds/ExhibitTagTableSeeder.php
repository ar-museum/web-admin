<?php

use App\Models\Exposition;
use Illuminate\Database\Seeder;

class ExhibitTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ExhibitTag::class, 12)->create();
    }
}