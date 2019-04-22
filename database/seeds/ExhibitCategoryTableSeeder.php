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
        DB::table('exhibit_categories')->insert([
            'category_id' => 1,
            'exhibit_id' => 1,
        ]);

        DB::table('exhibit_categories')->insert([
            'category_id' => 2,
            'exhibit_id' => 1,
        ]);

        DB::table('exhibit_categories')->insert([
            'category_id' => 3,
            'exhibit_id' => 1,
        ]);

        // factory(App\Models\ExhibitCategory::class, 3)->create();
    }
}