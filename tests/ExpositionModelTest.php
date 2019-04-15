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


    public function testPhotoRelationships()
    {
        $exposition = factory(App\Models\Exposition::class)->make($this->tempExposition);

        $this->assertNull($exposition->photo()->first());
    }
      public function testLastFive()
    {
        $tempExpo = factory(App\Models\Exposition::class, 5)->create($this->tempExposition)->sortByDesc('exposition_id');
         $stack = array();
        for ($index = 4; $index >= 0; --$index)
        {
            array_push($stack, $tempExpo->offsetGet($index)->toArray());
        }
         $tempExpo = $stack;
         $this->assertCount(5, $tempExpo);
         $expositions = Exposition::lastFive()->get();
         $this->assertEquals($tempExpo, $expositions->toArray());
     }
    
     public function testStaffRelationships()
    {
        $tempExpo = factory(App\Models\Exposition::class, 1)->create($this->tempExposition);
        $this->assertNull($tempExpo->staff()->first());
        $exposition = Exposition::find(1);
        $staff = new App\Models\Staff([
            'first_name'     => 'Vasile',
            'last_name'      => 'Popescu',
            'email'          => 'gigel@museum.lc',
            'password'       => 'parola',
            'remember_token' => '321',
        ]);
        $exposition->staff()->save($staff);
        $staff = $exposition->staff()->get();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exposition->staff()->get());
        $this->assertCount(2, $staff->toArray());
        $this->assertEquals($staff->toArray(), $author->staff()->orderBy('staff_id', 'desc')->first()->toArray());
    }



}
