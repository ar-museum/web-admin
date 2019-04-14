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
            'title' => 'Mihai Eminescu',
            'description' => 'Popescu',
            'museum_id' => 2,
            'staff_id' => 2,
            'photo_id' => 2,
        ];
    }

    public function testCreatingModel()
    {
        $exposition = factory(App\Models\Exposition::class)->make($this->tempExposition);
        $this->assertGreaterThan(3, strlen($exposition->title));
        $this->assertGreaterThan(4, strlen($exposition->description));
        $this->assertTrue(true, is_int($exposition->museum_id));
        $this->assertTrue(true, is_int($exposition->staff_id));
        $this->assertTrue(true, is_int($exposition->photo_id));


    }

    public function testFailure()
    {
        $this->assertFileExists('app/Models/Exposition.php');

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
        $this->assertSame('expositions', (new App\Models\Exposition())->getTable());
        $this->assertSame('exposition_id', (new App\Models\Exposition())->getKeyName());
        $this->assertSame([
            'museum_id',
            'title',
            'description',
        ], (new App\Models\Exposition)->getFillable());
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

        $exhibits = $exposition>exhibits()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exposition>exhibits()->get());
        $this->assertCount(2, $exhibits->toArray());

        $this->assertEquals($exhibit->toArray(), $exposition->exhibits()->orderBy('exhibit_id', 'desc')->first()->toArray());
    }

    public function testStaffRelationships()
    {
        $tempExposition = factory(App\Models\Exposition::class, 1)->create($this->tempExposition);

        $this->assertNull($tempExposition->staff()->first());

        $exposition = \App\Models\Exposition::find(1);

        $staff = new \App\Models\Staff ([
            'first_name' => 'Gigel',
            'last_name' => 'Popescu',
            'email' => 'gigel@museum.lc',
            'password' =>  bcrypt('parola'),
            'photo_id' => 1,
            'remember_token' => str_random(10),
        ]);

        $exposition->staff()->save($staff);

        $staff = $exposition->staff()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exposition->staff()->get());
        $this->assertCount(2, $staff->toArray());

        $this->assertEquals($staff->toArray(), $exposition->staff()->orderBy('staff_id', 'desc')->first()->toArray());
    }

}
