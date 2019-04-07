<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MuseumModelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatingModel()
    {
        $museum = factory(App\Models\Museum::class)->make([
            'museum_id' => 1,
            'name' => 'Mihai Eminescu Museum',
            'address' => 'Copou Iasi',
            'opening_hour' => '08:00:00',
            'closing_hour' => '21:00:00',

        ]);
        $this->assertGreaterThan(3,strlen($museum->name));
        $this->assertGreaterThan(10,strlen($museum->address));
        $this->assertTrue(true,ctype_digit ( $museum->museum_id));



    }


    public function testExample()
    {
        $this->assertTrue(true);
    }
}
