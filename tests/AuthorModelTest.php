<?php

use App\Models\Author;
use App\Models\Exhibit;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorModelTest extends TestCase
{
    use DatabaseTransactions;
    private $tempAuthor;

    /**
     * A basic test example.
     *
     * @return void
     */

    protected function setUp()
    {

        parent::setUp();

        $this->tempAuthor = [
            'full_name' => "Mihai Eminescu",
            'born_year' =>'1850',
            'died_year'=>'1889',
            'location'=> 'Ipotesti',
            'photo_id'=> 1,
            'staff_id' =>1
        ];
    }

    public function testStaffId()
    {
        $author = factory(App\Models\Author::class)->make($this->tempAuthor);
        $this->assertTrue(true, is_int($author->staff_id));
    }

    public function testCreatingModel()
    {
        $author = factory(App\Models\Author::class)->make($this->tempAuthor);

        $this->assertEquals($this->tempAuthor['born_year'], $author->born_year);
        $this->assertGreaterThan(3, strlen($author->location));
        $this->assertEquals($this->tempAuthor['died_year'], $author->died_year);
        $this->assertNotEmpty($author->full_name);
        $this->assertEquals($this->tempAuthor['photo_id'] ,$author->photo_id);

        $this->assertFileExists('App/Models/Author.php');
        $this->assertInstanceOf(Author::class, new Author);
    }

    public function testCustomAttributes()
    {
        $this->assertSame('authors', (new App\Models\Author)->getTable());
        $this->assertSame('author_id', (new App\Models\Author)->getKeyName());
        $this->assertSame([
            'full_name',
            'born_year',
            'died_year',
            'location',
            'photo_id',
            'staff_id'
        ], (new App\Models\Author)->getFillable());
    }
    public function testSavedRowDatabase()
    {
        factory(App\Models\Author::class, 1)->create($this->tempAuthor);

        $this->seeInDatabase('authors', [
            'full_name' => $this->tempAuthor['full_name'],
        ]);
    }

    public function testStaffRelationships()
    {
        $tempAuthor = factory(App\Models\Author::class, 1)->create($this->tempAuthor);

        $this->assertNull($tempAuthor->staff()->first());

        $author = Author::find(1);

        $staff = new App\Models\Staff([
            'first_name'     => 'Vasile',
            'last_name'      => 'Popescu',
            'email'          => 'gigel@museum.lc',
            'password'       => 'parola',
            'remember_token' => '123',
        ]);

        $author->staff()->save($staff);

        $staff = $author->staff()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $author->staff()->get());
        $this->assertCount(2, $staff->toArray());

        $this->assertEquals($staff->toArray(), $author->staff()->orderBy('staff_id', 'desc')->first()->toArray());
    }

    public function testPhotoRelationships()
    {
        $tempAuthor = factory(App\Models\Author::class, 1)->create($this->tempAuthor);

        $this->assertNull($tempAuthor->photo()->first());

        $author = Author::find(1);

        $photo = new App\Models\Photo([
            'width'   => 30,
            'height'  => 50,
        ]);

        $author->photo()->save($photo);

        $photo = $author->photo()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $author->photo()->get());
        $this->assertCount(2, $photo->toArray());

        $this->assertEquals($photo->toArray(), $author->photo()->orderBy('staff_id', 'desc')->first()->toArray());
    }

    public function testExhibitsRelationships()
    {
        $tempAuthor = factory(App\Models\Author::class, 1)->create($this->tempAuthor);

        $this->assertNull($tempAuthor->exhibits()->first());

        $author = \App\Models\Author::find(1);

        $exhibit = new \App\Models\Exhibit([
            'title'             => 'Somnoroase Pasarele',
            'short_description' => 'Pe la cuiburi',
            'description'       => 'Cea mai splendida poezie ever!',
            'start_year'        => '1873',
            'end_year'          => '2019',
            'size'              => '20x30cm',
            'location'          => 'Iasi',
            'author_id'         => 1,
            'exposition_id'     => 1,
            'audio_id'          => 2,
            'photo_id'          => 1,
            'video_id'          => 3,
            'staff_id'          => 1,
        ]);

        $author->exhibits()->save($exhibit);

        $exhibits = $author->exhibits()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $author->exhibits()->get());
        $this->assertCount(2, $exhibits->toArray());

        $this->assertEquals($exhibit->toArray(), $author->exhibits()->orderBy('exhibit_id', 'desc')->first()->toArray());
    }

    public function testLastFive()
    {
        $tempAuthor = factory(App\Models\Author::class, 5)->create($this->tempAuthor)->sortByDesc('author_id');

        $stack = array();
        for ($index = 4; $index >= 0; --$index)
        {
            array_push($stack, $tempAuthor->offsetGet($index)->toArray());
        }

        $tempAuthor = $stack;

        $this->assertCount(5, $tempAuthor);

        $authors = Author::lastFive()->get();

        $this->assertEquals($tempAuthor, $authors->toArray());
    }

    public function testGetPhotoPath()
    {
        $tempAuthor = factory(App\Models\Author::class, 1)->create($this->tempAuthor);

        $this->assertNotEmpty($tempAuthor->getPhotoPath());
        $this->assertNotEquals($tempAuthor->getPhotoPath(), null);
    }
}
