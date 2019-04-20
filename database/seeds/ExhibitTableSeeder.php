<?php

use Illuminate\Database\Seeder;

class ExhibitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Exhibit::class, 50)->create();
    }
}
