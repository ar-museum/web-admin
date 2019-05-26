<?php

use App\Models\Category;
use App\Models\Exhibit;
use App\Models\Exposition;
use App\Models\Photo;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExhibitModelTest extends TestCase
{
    use DatabaseTransactions;

    private $tempExhibit;

    /**
     * A basic test example.
     *
     * @return void
     */
    protected function setUp()
    {

        parent::setUp();

        $this->tempExhibit = [
            'short_description' => 'So deeeeep!',
            'description' => 'Cea maiiii splendida poezie ever!',
            'start_year' => '1878',
            'end_year' => '2010',
            'size' => '20x35cm',
            'location' => 'Galati',
        ];
    }


    public function testCreatingModel()
    {
        $exhibit = factory(App\Models\Exhibit::class)->make($this->tempExhibit);

        $this->assertGreaterThan(4, strlen($exhibit->short_description));
        $this->assertNotEmpty($exhibit->description);
        $this->assertEquals($this->tempExhibit['start_year'], $exhibit->start_year);
        $this->assertEquals($this->tempExhibit['end_year'], $exhibit->end_year);
        $this->assertEquals($this->tempExhibit['size'], $exhibit->size);
        $this->assertEquals($this->tempExhibit['location'], $exhibit->location);


        $this->assertFileExists('App/Models/Exhibit.php');
        $this->assertInstanceOf(Exhibit::class, new Exhibit);
    }

    public function testCustomAttributes()
    {
        $this->assertSame('exhibits', (new App\Models\Exhibit)->getTable());
        $this->assertSame('exhibit_id', (new App\Models\Exhibit)->getKeyName());
        $this->assertSame([
            'title',
            'short_description',
            'description',
            'start_year',
            'end_year',
            'size',
            'location',
            'author_id',
            'exposition_id',
            'staff_id',
            'audio_id',
            'photo_id',
            'video_id'
        ], (new App\Models\Exhibit)->getFillable());
    }


    public function testSavedRowDatabase()
    {
        $this->tempExhibit['title'] = 'Ala bala';
        factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->seeInDatabase('exhibits', [
            'title' => $this->tempExhibit['title'],
        ]);

        unset($this->tempExhibit['title']);
    }

    public function testExpositionsRelationships()
    {
        $exposition = factory(App\Models\Exposition::class, 1)->create(['title' => 'Carti Mihai Eminescu',
            'description' => 'Cea mai veche carte',
            'museum_id' => 1,
            'photo_id' => 1,
            'staff_id' => 1,]);

        $this->tempExhibit['exposition_id'] = $exposition->exposition_id;

        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNotNull($tempExhibit->expositions()->first());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $tempExhibit->expositions()->get());;

        $this->assertEquals($exposition->toArray(), $tempExhibit->expositions()->orderBy('exposition_id', 'desc')->first()->toArray());
    }

    public function testCategoriesRelationships()
    {
        $category = factory(App\Models\Category::class, 1)->create(['name' => 'Literaturi']);

        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->categories()->first());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $tempExhibit->categories()->get());

        $this->assertEquals($category->toArray(), $tempExhibit->categories()->orderBy('category_id', 'desc')->first()->toArray());
    }

    public function testTagsRelationships()
    {
        $tag = factory(App\Models\Tag::class, 1)->create(['name' => 'Drama']);

        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->tags()->first());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $tempExhibit->tags()->get());

        $this->assertEquals($tag->toArray(), $tempExhibit->tags()->orderBy('tag_id', 'desc')->first()->toArray());
    }

    public function testAuthorsRelationships()
    {
        $authors = factory(App\Models\Author::class, 1)->create([
            'full_name' => 'Mihai Eminescu',
            'born_year' => '1850',
            'died_year' => '1889',
            'location' => 'Ipotesti',
            'photo_id' => 1,
            'staff_id' => 1,
        ]);

        $this->tempExhibit['author_id'] = $authors->author_id;

        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNotNull($tempExhibit->authors()->first());

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $tempExhibit->authors()->get());;

        $this->assertEquals($authors->toArray(), $tempExhibit->authors()->orderBy('author_id', 'desc')->first()->toArray());
    }

    public function testStaffRelationships()
    {
        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->staff()->first());

        $exhibit = \App\Models\Exhibit::find(1);

        $staff = new \App\Models\Staff ([
            'first_name' => 'Gigel',
            'last_name' => 'Popescu',
            'email' => 'gigel@museum.lc',
            'password' =>  bcrypt('parola'),
            'photo_id' => 1,
            'remember_token' => str_random(10),
        ]);

        $exhibit->staff()->save($staff);

        $staff = $exhibit->staff()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit->staff()->get());
        $this->assertCount(2, $staff->toArray());

        $this->assertEquals($staff->toArray(), $exhibit->staff()->orderBy('staff_id', 'desc')->first()->toArray());
    }

    public function testPhotoRelationships()
    {
        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->photo()->first());

        $exhibit = Exhibit::find(1);

        $photo = new App\Models\Photo([
            'width' => 30,
            'height' => 50,
        ]);

        $exhibit->photo()->save($photo);

        $photo = $exhibit->photo()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit->photo()->get());
        $this->assertCount(2, $photo->toArray());

        $this->assertEquals($photo->toArray(), $exhibit->photo()->orderBy('staff_id', 'desc')->first()->toArray());
    }

    public function testAudioRelationships()
    {
        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->audio()->first());

        $exhibit = Exhibit::find(1);

        $audio = new App\Models\Audio([
            'length' => 50,
        ]);

        $exhibit->audio()->save($audio);

        $audio = $exhibit->audio()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit->audio()->get());
        $this->assertCount(2, $audio->toArray());

        $this->assertEquals($audio->toArray(), $exhibit->audio()->orderBy('staff_id', 'desc')->first()->toArray());
    }

    public function testVideoRelationships()
    {
        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->video()->first());

        $exhibit = Exhibit::find(1);

        $video = new App\Models\Video([
            'length' => 80,
        ]);

        $exhibit->video()->save($video);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit->video()->get());
        $this->assertCount(1, $video->toArray());

        $this->assertEquals($video->toArray(), $exhibit->video()->orderBy('staff_id', 'desc')->first()->toArray());
    }


    public function testLastFive()
    {
        $tempExhibits = factory(App\Models\Exhibit::class, 5)->create($this->tempExhibit)->sortByDesc('exhibit_id');

        $stack = array();
        for ($index = 4; $index >= 0; --$index)
        {
            array_push($stack, $tempExhibits->offsetGet($index)->toArray());
        }

        $tempExhibits = $stack;

        $this->assertCount(5, $tempExhibits);

        $exhibits = Exhibit::lastFive()->get();

        $this->assertEquals($tempExhibits, $exhibits->toArray());


    }

    public function testSetGetValue()
    {
        $exhibit = factory(App\Models\Exhibit::class)->make($this->tempExhibit);

        $exhibit->setValue(10);

        $this->assertNotEmpty($exhibit->getValue());
        $this->assertEquals($exhibit->getValue(),10);
    }

    public function testGetPhotoPath()
    {
        $exhibit = factory(App\Models\Exhibit::class)->make($this->tempExhibit);
        $exhibit->photo_id = 1;

        $this->assertNotEmpty($exhibit->getPhotoPath());
        $this->assertNotEquals($exhibit->getPhotoPath(), null);
    }

    public function testGetAudioPath()
    {
        $exhibit = factory(App\Models\Exhibit::class)->make($this->tempExhibit);
        $exhibit->audio_id = 3;

        $this->assertNotEmpty($exhibit->getAudioPath());
        $this->assertNotEquals($exhibit->getAudioPath(), null);

    }

    public function testGetVideoPath()
    {
        $exhibit = factory(App\Models\Exhibit::class)->make($this->tempExhibit);
        $exhibit->video_id = 4;

        $this->assertNotEmpty($exhibit->getVideoPath());
        $this->assertNotEquals($exhibit->getVideoPath(), null);

    }
}