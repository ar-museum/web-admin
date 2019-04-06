<?php

use App\Models\Exhibit;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExhibitModelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExhibitModel() {
        $exhibit = factory(App\Models\Exhibit::class)->make([
            'title' => 'Floare albastra',
            'short_description' => 'So deep!',
            'description' => 'Cea mai splendida poezie ever!',
            'start_year' => '1873',
            'end_year' => '2019',
            'size' => '20x30cm',
            'location' => 'Iasi',
            'author_id' => 1,
            'exposition_id' => 1,
            'staff_id' => 1
        ]);

        /**
         * Rows validation
         */
        $this->assertLessThan(7, strlen($exhibit->title));
        $this->assertGreaterThan(4, strlen($exhibit->short_description));
        $this->assertEmpty($exhibit->description);
        $this->assertEquals('1873', $exhibit->start_year);
        $this->assertNotEquals('2018', $exhibit->end_year);
        $this->assertStringStartsWith('20', $exhibit->size);
        $this->assertFinite($exhibit->location);
        $this->assertObjectHasAttribute($exhibit->author_id, new Exhibit);
        $this->assertTrue(true, is_int($exhibit->exposition_id));
        $this->assertFalse(false, is_int($exhibit->exposition_id));

        /**
         * Model creation
         */
        $this->assertFileExists('App/Models/Exhibit.php');
        $this->assertInstanceOf(Exhibit::class, new Exhibit);
    }
}
