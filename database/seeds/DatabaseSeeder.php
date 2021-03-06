<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(MediaTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(MuseumTableSeeder::class);

        $this->call(AuthorTableSeeder::class);
        $this->call(ExpositionTableSeeder::class);

        #$this->call(TagTableSeeder::class);
        $this->call(CategoryTableSeeder::class);

        $this->call(ExhibitTableSeeder::class);
        $this->call(ExhibitTagTableSeeder::class);
        $this->call(ExhibitCategoryTableSeeder::class);

        $this->call(VuforiaTableSeeder::class);
        $this->call(DragndropTableSeeder::class);
        $this->call(TriviaTableSeeder::class);
        Model::reguard();
    }
}