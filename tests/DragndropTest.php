<?php

use App\Models\Museum;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DragndropTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    private $tempDragndrop;

    /**
     * A basic test example.
     *
     * @return void
     */
    protected function setUp()
    {

        parent::setUp();

        $this->tempDragndrop = [
            'museum_id' => 1,
            'path' => 'uploads\photo\dragndrop\MuzeulMihaiEminescu\Muzeul-„Mihai-Eminescu”.jpg',
        ];
    }

    public function testCreatingModel()
    {
        $dragndrop = factory(App\Models\Dragndrop::class)->make($this->tempDragndrop);

        $this->assertTrue(true, is_int($dragndrop->museum_id));
    }

    public function testMuseumRelationships()
    {
        $tempDragndrop = factory(App\Models\Dragndrop::class, 1)->create($this->tempDragndrop);
        $this->assertNull($tempDragndrop->museum()->first());
        $dragndrop = Dragndrop::find(1);
        $museum = factory(App\Models\Museum::class)->make([
            'museum_id' => 1,
            'name' => 'Mihai Eminescu Museum',
            'address' => 'Copou Iasi',
            'opening_hour' => '08:00:00',
            'closing_hour' => '21:00:00',

        ]);
        $dragndrop->museum()->save($museum);
        $museum = $dragndrop->museum()->get();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $dragndrop->museum()->get());
        $this->assertCount(2, $museum->toArray());
        $this->assertEquals($museum->toArray(), $dragndrop->museum()->orderBy('museum_id', 'desc')->first()->toArray());
    }

}
