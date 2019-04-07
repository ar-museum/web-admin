<?php

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Photo::class, 1)->create();
        factory(App\Models\Audio::class, 1)->create();
        factory(App\Models\Video::class, 1)->create();
    }
}
