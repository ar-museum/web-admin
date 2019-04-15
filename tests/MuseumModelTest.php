<?php

use App\Models\Exhibit;
use App\Models\Exposition;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MuseumModelTest extends TestCase
{

    use DatabaseTransactions;
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
        $this->assertGreaterThan(6,strlen($museum->address));
        $this->assertTrue(true,ctype_digit ( $museum->museum_id));



    }


    public function testExpositionsRelationships()
    {
        $exposition = factory(App\Models\Exposition::class, 1)->create([
            'title' => 'Tablouri mai putin cunoscute',
            'description' => 'Tablouri ale unor artisti amatori locali',
        ]);

        $this->tempMuseum['museum_id'] = $exposition->museum_id;

        $tempMuseum = factory(App\Models\Museum::class, 1);

        $this->assertNotNull($tempMuseum->expositions()->first());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $tempMuseum->expositions()->get());;

        $this->assertEquals($exposition->toArray(), $tempMuseum->expositions()->orderBy('exposition_id', 'desc')->first()->toArray());
    }

    public function testExample()
    {
        $this->assertTrue(true);
    }
}
