<?php

use App\Models\Museum;
use Illuminate\Database\Seeder;

class MuseumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Museum::class, 1)->create();
        factory(App\Models\Museum::class, 1)->create([
            'name' => 'Muzeul de Științe Naturale',
            'longitude'=>47.166822,
            'latitude'=>27.584079
        ]);
    }
}