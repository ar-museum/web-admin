<?php

use App\Models\Exhibit;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExhibitModelTest extends TestCase
{

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
            'title' => 'Floarea albastra',
            'short_description' => 'So deeeeep!',
            'description' => 'Cea maiiii splendida poezie ever!',
            'start_year' => '1878',
            'end_year' => '2010',
            'size' => '20x35cm',
            'location' => 'Galati',
            'author_id' => 1,
            'exposition_id' => 1,
            'staff_id' => 1,
            'audio_id' => 2,
            'photo_id' => 1,
            'video_id' => 3,
        ];
    }

    /**
     * Rows validation
     */

    public function testCreatingModel()
    {
        $exhibit = factory(App\Models\Exhibit::class)->make($this->tempExhibit);

        $this->assertLessThan(20, strlen($exhibit->title));
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
        factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->seeInDatabase('exhibits', [
            'title' => $this->tempExhibit['title'],
        ]);
    }

    public function testExpositionsRelationships()
    {
        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->expositions()->first());

        $exhibit = \App\Models\Exhibit::find(1);

        $exposition = new \App\Models\Exposition([
            'title'       => 'Literatura contemporana',
            'description' => 'Scriitorii secolului XX',
            'museum_id'   => 1,
        ]);

        $exhibit->expositions()->save($exposition);

        $expositions = $exhibit->expositions()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit->expositions()->get());
        $this->assertCount(2, $expositions->toArray());

        $this->assertEquals($exposition->toArray(), $exhibit->expositions()->orderBy('exposition_id', 'desc')->first()->toArray());
    }

    public function testCategoriesRelationships()
    {
        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->exhibits()->first());

        $exhibit = \App\Models\Exhibit::find(1);

        $category = new \App\Models\Category(['name' => 'Litaraturi']);

        $exhibit->categories()->save($category);

        $categories = $exhibit->categories()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit->categories()->get());
        $this->assertCount(4, $categories->toArray());

        $this->assertEquals($category->toArray(), $exhibit->categories()->orderBy('category_id', 'desc')->first()->toArray());
    }

    public function testTagsRelationships()
    {
        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->exhibits()->first());

        $exhibit = \App\Models\Exhibit::find(1);

        $tag = new \App\Models\Tag(['name' => 'Poezii']);

        $exhibit->tags()->save($tag);

        $tags = $exhibit->tags()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit->tags()->get());
        $this->assertCount(4, $tags->toArray());

        $this->assertEquals($tag->toArray(), $exhibit->tags()->orderBy('tag_id', 'desc')->first()->toArray());
    }

    public function testAuthorsRelationships()
    {
        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->exhibits()->first());

        $exhibit = \App\Models\Exhibit::find(1);

        $author = new \App\Models\Author([
            'full_name' => 'Ion Creanga',
            'born_year' => '1850',
            'died_year' => '1889',
            'location'  => 'Vaslui',
            'photo_id'  => 1,
        ]);

        $exhibit->authors()->save($author);

        $authors = $exhibit->authors()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit->authors()->get());
        $this->assertCount(2, $authors->toArray());

        $this->assertEquals($author->toArray(), $exhibit->authors()->orderBy('author_id', 'desc')->first()->toArray());
    }

    public function testStaffRelationships()
    {
        $tempExhibit = factory(App\Models\Exhibit::class, 1)->create($this->tempExhibit);

        $this->assertNull($tempExhibit->exhibits()->first());

        $exhibit = \App\Models\Exhibit::find(1);

        $staff = new \App\Models\Staff([
            'first_name'     => 'Vasile',
            'last_name'      => 'Popescu',
            'email'          => 'gigel@museum.lc',
            'password'       => 'parola',
            'remember_token' => '123',
        ]);

        $exhibit->staff()->save($staff);

        $staff = $exhibit->staff()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit->staff()->get());
        $this->assertCount(2, $staff->toArray());

        $this->assertEquals($staff->toArray(), $exhibit->staff()->orderBy('staff_id', 'desc')->first()->toArray());
    }

}