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
        // @TODO: Add missing id column & fix incorrect named columns
        DB::table('museum')->insert([
            'name' => 'AR Museum',
            'address' => 'Parcul Copou, Iași, județul Iași',
            'opening_time' => '08:00:00',
            'closing_time' => '21:00:00',
        ]);
    }
}
