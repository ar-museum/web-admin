<?php

use Illuminate\Database\Seeder;

class VuforiaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Vuforia::class, 1)->create();
    }
}