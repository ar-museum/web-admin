<?php

use Illuminate\Database\Seeder;

class Tag extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tag')->insert([
            'tag_id' => 1,
            'name' => 'dramatic',
            'staff_id' => 1
        ]);
    }
}
