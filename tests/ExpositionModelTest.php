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
    public function testCreatingModel()
    {
        $exposition = factory(App\Models\Exposition::class)->make([
            'title' => 'Mihai Eminescu',
            'description' => 'Popescu',
            'museum_id' => 2,
            'staff_id' => 2,
            'photo_id' => 'id',
        ]);
        $this->assertGreaterThan(3, strlen($exposition->title));
        $this->assertGreaterThan(4, strlen($exposition->description));
        $this->assertTrue(true, is_int($exposition->museum_id));
        $this->assertTrue(true, is_int($exposition->staff_id));
        $this->assertTrue(true, is_int($exposition->photo_id));
        $this->assertEmpty($exposition->description);


    }

    public function testFailure()
    {
        $this->assertFileExists('app/Models/Exposition.php');

        $this->assertInstanceOf(\App\Models\Exposition::class, new Exposition);
    }
}
