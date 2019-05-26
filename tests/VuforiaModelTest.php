<?php

use App\Models\Museum;
use App\Models\Vuforia;
use App\Models\VuforiaFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VuforiaModelTest extends TestCase
{
    use DatabaseTransactions;

    private $tempVuforia;
    private $tempVuforiaFile;

    protected function setUp()
    {
        parent::setUp();

        $this->tempVuforiaFile = factory(VuforiaFile::class)->create([
            'path' => 'exampleFileUnitTest.dat'
        ]);

        $this->tempVuforia = [
            'museum_id' => 1,
            'version' => 1.12,
            'file_id' => $this->tempVuforiaFile->file_id
        ];
    }

    public function testCreatingModel()
    {
        $vuforia = factory(Vuforia::class)->make($this->tempVuforia);

        $this->assertNotNull(
            $vuforia->vuforia_id,
            'vuforia_id is null'
        );

        $this->assertNotEmpty(
            $vuforia->vuforia_id,
            'vuforia_id is empty'
        );

        $this->assertTrue(
            is_int($vuforia->vuforia_id),
            'vuforia_id is not an integer'
        );

        $this->assertNotNull(
            $vuforia->museum_id,
            'museum_id is null'
        );

        $this->assertNotEmpty(
            $vuforia->museum_id,
            'museum_id is empty'
        );

        $this->assertTrue(
            is_int($vuforia->museum_id),
            'museum_id is not an integer'
        );

        $this->assertNotNull(
            $vuforia->file_id,
            'file_id is null'
        );

        $this->assertNotEmpty(
            $vuforia->file_id,
            'file_id is empty'
        );

        $this->assertTrue(
            is_int($vuforia->file_id),
            'file_id is not an integer'
        );
    }

    public function testMuseumRelationships()
    {
        $museum = factory(Museum::class)->create([
            'name' => 'Test Museum',
            'address' => 'Test Area'
        ]);

        $vuforia = factory(Vuforia::class)->make([
            'museum_id' => $museum->museum_id,
            'version' => 1.15,
            'file_id' =>  $this->tempVuforiaFile->file_id
        ]);

        $this->assertNotNull(
            $vuforia->museum()->get()->last()->museum_id,
            'museum_id is null'
        );

        $this->assertNotEmpty(
            $vuforia->museum()->get()->last()->museum_id,
            'museum_id is empty'
        );

        $this->assertTrue(
            is_int($vuforia->museum()->get()->last()->museum_id),
            'museum_id is not an integer'
        );

        $this->assertSame(
            $vuforia->museum()->get()->last()->museum_id,
            $vuforia->museum_id,
            'foreign key museum_id is not correct'
        );
    }

    public function testFileRelationships()
    {
        $vuforiaFile = factory(VuforiaFile::class)->create([
            'path' => 'exampleFileUnitTest.xml'
        ]);

        $vuforia = factory(Vuforia::class)->make([
            'version' => 1.15,
            'file_id' =>  $vuforiaFile->file_id
        ]);

        $this->assertNotNull(
            $vuforia->file()->get()->last()->file_id,
            'file_id is null'
        );

        $this->assertNotEmpty(
            $vuforia->file()->get()->last()->file_id,
            'file_id is empty'
        );

        $this->assertTrue(
            is_int($vuforia->file()->get()->last()->file_id),
            'file_id is not an integer'
        );

        $this->assertSame(
            $vuforia->file()->get()->last()->file_id,
            $vuforia->file_id,
            'foreign key file_id is not correct'
        );
    }
}