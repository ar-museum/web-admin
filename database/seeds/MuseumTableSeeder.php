<?php

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
        DB::table('museum')->insert([
            'museum_id'=>'1',
            'name' => 'AR Museum',
            'address' => 'Parcul Copou, Iași, județul Iași',
            'opening_hour' => '08:00:00',
            'closing_hour' => '21:00:00',
        ]);
    }
}
