<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category_id' => 1,
            'name' => 'Poezie',
            'staff_id' => 1,
            'created_at' => date('Y.m.d h.m.i'),
            'updated_at' => date('Y.m.d h.m.i')
        ]);

        DB::table('categories')->insert([
            'category_id' => 2,
            'name' => 'Roman',
            'staff_id' => 1,
            'created_at' => date('Y.m.d h.m.i'),
            'updated_at' => date('Y.m.d h.m.i')
        ]);

        DB::table('categories')->insert([
            'category_id' => 3,
            'name' => 'Balada',
            'staff_id' => 1,
            'created_at' => date('Y.m.d h.m.i'),
            'updated_at' => date('Y.m.d h.m.i')
        ]);

        // factory(App\Models\Category::class, 3)->create();
    }
}
