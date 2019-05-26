<?php

use App\Models\Museum;
use App\Models\Trivia;

class TriviaModelTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;
    private $tempTrivia;

    protected function setUp()
    {

        parent::setUp();

        $this->tempTrivia = [
            'json_name' => 'text.json',
            'museum_id' => 1
        ];
    }

    public function testCreatingModel()
    {
        $trivia = factory(App\Models\Trivia::class)->make($this->tempTrivia);

        $this->assertEquals($this->tempTrivia['json_name'], $trivia->json_name);

        $this->assertFileExists('App/Models/Trivia.php');
        $this->assertInstanceOf(Trivia::class, new Trivia);
    }

    public function testCustomAttributes()
    {
        $this->assertSame('trivia', (new App\Models\Trivia)->getTable());
        $this->assertSame('trivia_id', (new App\Models\Trivia)->getKeyName());
        $this->assertSame([
            'json_name',
            'museum_id'
        ], (new App\Models\Trivia)->getFillable());
    }

    public function testSavedRowDatabase()
    {
        factory(App\Models\Trivia::class, 1)->create($this->tempTrivia);

        $this->seeInDatabase('trivia', [
            'json_name' => $this->tempTrivia['json_name'],
        ]);
    }

    public function testMuseumRelationships()
    {
        $tempTriv = factory(App\Models\Trivia::class, 1)->create($this->tempTrivia);

        $this->assertNull($tempTriv->museum()->first());

        $trivia = Trivia::find(1);

        $museum = factory(App\Models\Museum::class)->make([
            'museum_id' => 1,
            'name' => 'Mihai Eminescu Museum',
            'address' => 'Copou Iasi',
            'opening_hour' => '08:00:00',
            'closing_hour' => '21:00:00',

        ]);
        $trivia->museum()->save($museum);
        $museum = $trivia->museum()->get();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $trivia->museum()->get());
        $this->assertCount(2, $museum->toArray());
        $this->assertEquals($museum->toArray(), $trivia->museum()->orderBy('museum_id', 'desc')->first()->toArray());
    }

}