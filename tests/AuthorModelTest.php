<?php
use App\Models\Author;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorModelTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAuthorModel()
    {
        $author = factory(App\Models\Author::class)->make([
            'full_name' => 'Mihai Eminescu',
            'born_year' => '1850',
            'died_year' => '1889',
            'location' => 'Ipotesti',
            'photo_id' => 1,
            'staff_id' =>1
        ]);

        $this->assertEquals('1850',$author->born_year);
        $this->assertGreaterThan(3,strlen($author->location));
        $this->assertNotEquals('1856',$author->died_year);
        $this->assertEmpty($author->full_name);
        $this->assertObjectHasAttribute($author->staff_id, new Author);
        $this->assertTrue(true, is_int($author->photo_id));

        $this->assertFileExists('App/Models/Author.php');
        $this->assertInstanceOf(Author::class, new Author);
    }
}

