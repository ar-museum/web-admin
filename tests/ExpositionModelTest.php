<?php

use App\Models\Exposition;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExpositionModelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


    use DatabaseTransactions;

    private $tempExposition;

    /**
     * A basic test example.
     *
     * @return void
     */
    protected function setUp()
    {

        parent::setUp();

        $this->tempExposition = [
            'title' => 'Carti Mihai Eminescu',
            'description' => 'Cea mai veche carte',
            'museum_id' => 1,
            'staff_id' => 1,
            'photo_id' => 1,
        ];
    }

    public function testCreatingModel()
    {
        $exposition = factory(App\Models\Exposition::class)->make($this->tempExposition);

        $this->assertTrue(true, is_int($exposition->photo_id));


    }

    public function testTitleLength()
    {
        $exposition = factory(App\Models\Exposition::class)->make($this->tempExposition);
        $this->assertGreaterThan(3, strlen($exposition->title));
    }

    public function testDescLength()
    {
        $exposition = factory(App\Models\Exposition::class)->make($this->tempExposition);
        $this->assertGreaterThan(4, strlen($exposition->description));

    }

    public function testMuseumId()
    {
        $exposition = factory(App\Models\Exposition::class)->make($this->tempExposition);
        $this->assertTrue(true, is_int($exposition->museum_id));

    }

    public function testStaffId()
    {
        $exposition = factory(App\Models\Exposition::class)->make($this->tempExposition);
        $this->assertTrue(true, is_int($exposition->staff_id));

    }


    public function testFailure()
    {
        $this->assertFileExists('app/Models/Exposition.php');


    }

    public function testRelationship()
    {
        $this->assertInstanceOf(\App\Models\Exposition::class, new Exposition);
    }

    public function testSavedRowDatabase()
    {
        $this->tempExposition['title'] = 'Carti Mihai Eminescu';
        factory(App\Models\Exposition::class, 1)->create($this->tempExposition);

        $this->seeInDatabase('expositions', [
            'title' => $this->tempExposition['title'],
        ]);

        unset($this->tempExposition['title']);
    }

    public function testCustomAttributes()
    {


        $this->assertSame([
            'museum_id',
            'title',
            'description',
        ], (new App\Models\Exposition)->getFillable());
    }

    public function testTableIdentic()
    {
        $this->assertSame('expositions', (new App\Models\Exposition())->getTable());
    }

    public function testRowIdentic()
    {
        $this->assertSame('exposition_id', (new App\Models\Exposition())->getKeyName());
    }


    public function testPhotoRelationships()
    {
        $exposition = factory(App\Models\Exposition::class)->make($this->tempExposition);

        $this->assertNull($exposition->photo()->first());
    }


    public function testLastFive()
    {
        $tempExposittion = factory(App\Models\Exposition::class, 5)->create($this->tempExposition)->sortByDesc('exposition_id');

        $stack = array();
        for ($index = 4; $index >= 0; --$index)
        {
            array_push($stack, $tempExposittion->offsetGet($index)->toArray());
        }

        $tempExposittion = $stack;

        $this->assertCount(5, $tempExposittion);

        $expoos = Exposition::lastFive()->get();

        $this->assertEquals($tempExposittion, $expoos->toArray());


    }

    public function testStaffRelationships()
    {
        $tempExpo = factory(App\Models\Exposition::class, 1)->create($this->tempExposition);
        $this->assertNull($tempExpo->staff()->first());
        $exposition = Exposition::find(1);
        $staff = new App\Models\Staff([
            'first_name' => 'Vasile',
            'last_name' => 'Popescu',
            'email' => 'gigel@museum.lc',
            'password' => 'parola',
            'remember_token' => '321',
        ]);
        $exposition->staff()->save($staff);
        $staff = $exposition->staff()->get();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exposition->staff()->get());
        $this->assertCount(2, $staff->toArray());
        $this->assertEquals($staff->toArray(), $exposition->staff()->orderBy('staff_id', 'desc')->first()->toArray());
    }

    public function testExhibitsRelationships()
    {
        $tempExposition = factory(App\Models\Exposition::class, 1)->create($this->tempExposition);

        $this->assertNull($tempExposition->exhibits()->first());

        $exposition = \App\Models\Exposition::find(1);

        $exhibit = new \App\Models\Exhibit([
            'title'             => 'Somnoroase Pasarele',
            'short_description' => 'Pe la cuiburi',
            'description'       => 'Cea mai splendida poezie ever!',
            'start_year'        => '1873',
            'end_year'          => '2019',
            'size'              => '20x30cm',
            'location'          => 'Iasi',
            'author_id'         => 1,
            'exposition_id'     => 1,
            'audio_id'          => 2,
            'photo_id'          => 1,
            'video_id'          => 3,
        ]);

        $exposition->exhibits()->save($exhibit);

        $exhibits = $exposition->exhibits()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exposition->exhibits()->get());
        $this->assertCount(2, $exhibits->toArray());

        $this->assertEquals($exhibit->toArray(), $exposition->exhibits()->orderBy('exhibit_id', 'desc')->first()->toArray());
    }


    public function testMuseumRelationships()
    {
        $tempExpo = factory(App\Models\Exposition::class, 1)->create($this->tempExposition);
        $this->assertNull($tempExpo->museum()->first());
        $exposition = Exposition::find(1);
        $museum = factory(App\Models\Museum::class)->make([
            'museum_id' => 1,
            'name' => 'Mihai Eminescu Museum',
            'address' => 'Copou Iasi',
            'opening_hour' => '08:00:00',
            'closing_hour' => '21:00:00',

        ]);
        $exposition->museum()->save($museum);
        $museum = $exposition->museum()->get();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exposition->museum()->get());
        $this->assertCount(2, $museum->toArray());
        $this->assertEquals($museum->toArray(), $exposition->museum()->orderBy('museum_id', 'desc')->first()->toArray());
    }



}
