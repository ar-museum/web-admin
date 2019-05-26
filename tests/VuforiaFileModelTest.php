<?php

use App\Models\Vuforia;
use App\Models\VuforiaFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VuforiaFileModelTest extends TestCase
{
    use DatabaseTransactions;

    private $tempVuforiaFile;

    protected function setUp()
    {
        parent::setUp();

        $this->tempVuforiaFile = [
            'file_id' => 1,
            'path' => 'uploads\files\testFile.xml'
        ];
    }

    public function testCreatingModel()
    {
        $this->tempVuforiaFile = [
            'file_id' => 1,
            'path' => 'uploads\files\testFile.xml'
        ];

        $vuforiaFile = factory(VuforiaFile::class)->make($this->tempVuforiaFile);

        $this->assertNotEmpty(
            $vuforiaFile->file_id,
            'file_id is empty'
        );

        $this->assertTrue(
            is_int($vuforiaFile->file_id),
            'file_id is not an integer'
        );

        $this->assertNotEmpty(
            $vuforiaFile->path,
            'path is empty'
        );

        $this->assertSame(
            'uploads\files\testFile.xml',
            $vuforiaFile->path,
            'actual path and inserted path are not the same'
        );
    }

    public function testVuforiaRelationships()
    {
        $this->tempVuforiaFile['file_id'] = 2;

        $vuforiaFile = factory(VuforiaFile::class)->create($this->tempVuforiaFile);

        $vuforia_id = Vuforia::all()->last()->vuforia_id; $vuforia_id++;

        $vuforia = factory(Vuforia::class)->create([
            'vuforia_id' => $vuforia_id,
            'museum_id' => 1,
            'version' => 1.5,
            'file_id' => $vuforiaFile->file_id
        ]);

        $this->assertNotEmpty(
            $vuforia->file_id,
            'file_id is not set in table vuforia'
        );

        $this->assertEquals(
            $vuforia->file_id,
            $vuforiaFile->file_id,
            'foreign key file_is is not correct (1)'
        );

        $this->assertEquals(
            $vuforia->file_id,
            $vuforiaFile->vuforia()->get()[0]->file_id,
            'foreign key file_is is not correct (2)'
        );
    }

    public function testLastFive()
    {
        $tempVuforiaFile = factory(VuforiaFile::class, 5)->create([
            'path' => 'exampleTest.dat'
        ]);

        $tempVuforiaFile = $tempVuforiaFile->sortByDesc('file_id');

        $stack = array();

        for ($index = 4; $index >= 0; --$index)
        {
            array_push($stack, $tempVuforiaFile->offsetGet($index)->toArray());
        }

        $tempVuforiaFile = $stack;

        $this->assertCount(5, $tempVuforiaFile);

        $vuforiaFile = new VuforiaFile();

        $vuforiaFile = $vuforiaFile->scopeLastFive()->get();

        $this->assertEquals($tempVuforiaFile, $vuforiaFile->toArray());
    }

    public function testFileExistence()
    {
        $this->assertFileExists('app/Models/VuforiaFile.php');
    }

    public function testInstance()
    {
        $vuforiaFile = new VuforiaFile();
        $this->assertInstanceOf(VuforiaFile::class, $vuforiaFile);
    }
}