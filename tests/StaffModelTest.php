<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StaffModelTest extends TestCase
{
    use DatabaseTransactions;

    private $availableEmail = 'gigel@museum.lc';
    private $tempStaff;

    protected function setUp()
    {
        parent::setUp();

        $this->tempStaff = [
            'staff_id'       => 2,
            'first_name'     => 'Ion',
            'last_name'      => 'Popescu',
            'email'          => 'ion@museum.lc',
            'password'       => bcrypt('parola123!a'),
            'remember_token' => 'd131',
        ];
    }

    public function testCreatingModel()
    {
        $staff = factory(App\Models\Staff::class)->make($this->tempStaff);

        $this->assertLessThan(7, strlen($staff->first_name));
        $this->assertLessThan(8, strlen($staff->last_name));
        $this->assertNotEmpty($staff->remember_token);
        $this->assertTrue(filter_var($staff->email, FILTER_VALIDATE_EMAIL) === $this->tempStaff['email']);

        $this->assertEquals($this->tempStaff['email'], $staff->email);
        $this->assertEquals($this->tempStaff['password'], $staff->password);

        $this->assertEquals($staff->first_name . " " . $staff->last_name, $staff->full_name);
    }

    public function testCustomAttributes()
    {
        $this->assertSame('staff', (new App\Models\Staff)->getTable());
        $this->assertSame('staff_id', (new App\Models\Staff)->getKeyName());
        $this->assertSame([
                              'first_name',
                              'last_name',
                              'email',
                              'password',
                              'photo_id',
                          ], (new App\Models\Staff)->getFillable());

    }

    public function testSavedRowDatabase()
    {
        factory(App\Models\Staff::class, 1)->create($this->tempStaff);

        $this->seeInDatabase('staff', [
            'email' => $this->tempStaff['email'],
        ]);
    }

    public function testExpositionsRelationships()
    {
        $tempStaff = factory(App\Models\Staff::class, 1)->create($this->tempStaff);

        $this->assertNull($tempStaff->expositions()->first());

        $staff = \App\Models\Staff::find(1);

        $exposition = new \App\Models\Exposition([
                                                     'title'       => 'Literatura contemporana',
                                                     'description' => 'Scriitorii secolului XX',
                                                     'museum_id'   => 1,
                                                 ]);

        $staff->expositions()->save($exposition);

        $expositions = $staff->expositions()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $staff->expositions()->get());
        $this->assertCount(2, $expositions->toArray());

        $this->assertEquals($exposition->toArray(), $staff->expositions()->orderBy('exposition_id', 'desc')->first()->toArray());
    }

    public function testExhibitsRelationships()
    {
        $tempStaff = factory(App\Models\Staff::class, 1)->create($this->tempStaff);

        $this->assertNull($tempStaff->exhibits()->first());

        $staff = \App\Models\Staff::find(1);

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
                                           ]);

        $staff->exhibits()->save($exhibit);

        $exhibits = $staff->exhibits()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $staff->exhibits()->get());
        $this->assertCount(2, $exhibits->toArray());

        $this->assertEquals($exhibit->toArray(), $staff->exhibits()->orderBy('exhibit_id', 'desc')->first()->toArray());
    }

    public function testCategoriesRelationships()
    {
        $tempStaff = factory(App\Models\Staff::class, 1)->create($this->tempStaff);

        $this->assertNull($tempStaff->exhibits()->first());

        $staff = \App\Models\Staff::find(1);

        $category = new \App\Models\Category(['name' => 'Litaraturi']);

        $staff->categories()->save($category);

        $categories = $staff->categories()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $staff->categories()->get());
        $this->assertCount(4, $categories->toArray());

        $this->assertEquals($category->toArray(), $staff->categories()->orderBy('category_id', 'desc')->first()->toArray());
    }

    public function testTagsRelationships()
    {
        $tempStaff = factory(App\Models\Staff::class, 1)->create($this->tempStaff);

        $this->assertNull($tempStaff->exhibits()->first());

        $staff = \App\Models\Staff::find(1);

        $tag = new \App\Models\Tag(['name' => 'Poezii']);

        $staff->tags()->save($tag);

        $tags = $staff->tags()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $staff->tags()->get());
        $this->assertCount(4, $tags->toArray());

        $this->assertEquals($tag->toArray(), $staff->tags()->orderBy('tag_id', 'desc')->first()->toArray());
    }

    public function testAuthorsRelationships()
    {
        $tempStaff = factory(App\Models\Staff::class, 1)->create($this->tempStaff);

        $this->assertNull($tempStaff->exhibits()->first());

        $staff = \App\Models\Staff::find(1);

        $author = new \App\Models\Author([
                                             'full_name' => 'Ion Creanga',
                                             'born_year' => '1850',
                                             'died_year' => '1889',
                                             'location'  => 'Vaslui',
                                             'photo_id'  => 1,
                                         ]);

        $staff->authors()->save($author);

        $authors = $staff->authors()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $staff->authors()->get());
        $this->assertCount(2, $authors->toArray());

        $this->assertEquals($author->toArray(), $staff->authors()->orderBy('author_id', 'desc')->first()->toArray());
    }
}
