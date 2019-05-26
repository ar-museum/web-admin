<?php

use App\Models\Exhibit;
use App\Models\Exposition;
use App\Models\Museum;
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
            'museum_id' => 1
        ]);


        $tempMuseum = factory(App\Models\Museum::class, 1)->create();

        $tempMuseum->expositions()->save($exposition);

        $expositions = $tempMuseum->expositions()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $tempMuseum->expositions()->get());

        $this->assertCount(1, $expositions->toArray());

        $this->assertEquals($exposition->toArray(), $tempMuseum->expositions()->orderBy('exposition_id', 'desc')->first()->toArray());
    }

    public function testGetSetFunctions()
    {
        $museum = factory(App\Models\Museum::class)->make([
            'museum_id' => 100,
            'name' => 'Test Museum',
            'address' => 'Copou Iasi',
            'opening_hour' => '08:00:00',
            'closing_hour' => '21:00:00',
        ]);

        $museum->setMuseumLongitude(21.100);
        $this->assertNotEmpty($museum->getMuseumLongitude());
        $this->assertEquals($museum->getMuseumLongitude(), 21.100);

        $museum->setMuseumLatitude(68.213);
        $this->assertNotEmpty($museum->getMuseumLatitude());
        $this->assertEquals($museum->getMuseumLatitude(), 68.213);

        $museum->setMuseumName('unitTesting');
        $this->assertEquals($museum->getMuseumName(), 'unitTesting');

        $this->assertEquals($museum->getMuseumId(), 100);

        $museum->setMuseumAddress('bd. Carol I');
        $this->assertEquals($museum->getMuseumAddress(), 'bd. Carol I');

        $museum->setMondayProgram('08:00:00','17:30:00');
        $museum->setTuesdayProgram('08:00:00','17:30:00');
        $museum->setWednesdayProgram('08:00:00','17:30:00');
        $museum->setThursdayProgram('08:00:00','17:30:00');
        $museum->setFridayProgram('08:00:00','17:30:00');
        $museum->setSaturdayProgram('10:00:00','14:00:00');
        $museum->setSundayProgram('10:00:00','14:00:00');

        $this->assertNotEmpty($museum->getMondayProgram());
        $this->assertNotEmpty($museum->getTuesdayProgram());
        $this->assertNotEmpty($museum->getWednesdayProgram());
        $this->assertNotEmpty($museum->getThursdayProgram());
        $this->assertNotEmpty($museum->getFridayProgram());
        $this->assertNotEmpty($museum->getSaturdayProgram());
        $this->assertNotEmpty($museum->getSundayProgram());

    }
}
