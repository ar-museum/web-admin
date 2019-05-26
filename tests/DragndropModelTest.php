<?php

use App\Models\Museum;
use App\Models\Dragndrop;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DragndropModelTest extends TestCase
{
    use DatabaseTransactions;

    private $dragndrop;
    private $museum;

    protected function setUp()
    {
        parent::setUp();

        $this->museum = factory(Museum::class)->create([
            'name' => 'Test Museum',
            'address' => 'Test Area'
        ]);

        $this->dragndrop = [
            'museum_id' => $this->museum->museum_id,
            'path' => 'exampleFileUnitTest.dat'
        ];
    }

    public function testCreatingModel()
    {
        $dragndrop = factory(Dragndrop::class)->make($this->dragndrop);

        $this->assertNotNull(
            $dragndrop->dragndrop_id,
            'dragndrop_id is null'
        );

        $this->assertNotEmpty(
            $dragndrop->dragndrop_id,
            'dragndrop_id is empty'
        );

        $this->assertTrue(
            is_int($dragndrop->dragndrop_id),
            'dragndrop_id is not an integer'
        );

        $this->assertNotNull(
            $dragndrop->path,
            'path is null'
        );

        $this->assertNotEmpty(
            $dragndrop->path,
            'path is empty'
        );

        $this->assertTrue(
            is_string($dragndrop->path),
            'path is not a string'
        );
    }

    public function testMuseumRelationships()
    {
        $dragndrop = factory(Dragndrop::class)->make($this->dragndrop);

        $this->assertNotNull(
            $dragndrop->museum()->get()->last()->museum_id,
            'museum_id is null'
        );

        $this->assertNotEmpty(
            $dragndrop->museum()->get()->last()->museum_id,
            'museum_id is empty'
        );

        $this->assertTrue(
            is_int($dragndrop->museum()->get()->last()->museum_id),
            'museum_id is not an integer'
        );

        $this->assertSame(
            $dragndrop->museum()->get()->last()->museum_id,
            $dragndrop->museum_id,
            'foreign key museum_id is not correct'
        );
    }
}