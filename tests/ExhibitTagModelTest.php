<?php

use App\Models\Exhibit;
use App\Models\Tag;
use App\Models\ExhibitTag;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExhibitTagModelTest extends TestCase
{
    use DatabaseTransactions;

    private $exhibit;
    private $tag;

    protected function setUp()
    {
        parent::setUp();

        $this->exhibit = factory(Exhibit::class)->create([
            'short_description' => 'Another test description!',
            'description' => 'There is little shorter, but is also a description',
            'start_year' => '1999',
            'end_year' => '2005',
            'size' => '21x55cm',
            'location' => 'Bucuresti'
        ]);

        $this->tag = factory(Tag::class)->create([
            'name' => '#junimea'
        ]);
    }

    public function testCreatingModel()
    {
        $exhibitTag = factory(ExhibitTag::class)->make([
            'exhibit_id' => $this->exhibit->exhibit_id,
            'tag_id' => $this->tag->tag_id
        ]);

        $this->assertNotNull(
            $exhibitTag->exhibit_id,
            'exhibit_id is null'
        );

        $this->assertNotEmpty(
            $exhibitTag->exhibit_id,
            'exhibit_id is empty'
        );

        $this->assertTrue(
            is_int($exhibitTag->exhibit_id),
            'exhibit_id is not an integer'
        );

        $this->assertNotNull(
            $exhibitTag->tag_id,
            'tag_id is null'
        );

        $this->assertNotEmpty(
            $exhibitTag->tag_id,
            'tag_id is empty'
        );

        $this->assertTrue(
            is_int($exhibitTag->tag_id),
            'tag_id is not an integer'
        );
    }

    public function testExhibitRelationships()
    {
        $exhibitTag = factory(ExhibitTag::class)->make([
            'exhibit_id' => $this->exhibit->exhibit_id,
            'tag_id' => $this->tag->tag_id
        ]);

        $builder = $exhibitTag->exhibit();

        $this->assertNotEmpty(
            $builder,
            'exhibit builder empty'
        );
    }

    public function testCategoryRelationships()
    {
        $exhibitTag = factory(ExhibitTag::class)->make([
            'exhibit_id' => $this->exhibit->exhibit_id,
            'tag_id' => $this->tag->tag_id
        ]);

        $builder = $exhibitTag->tag();

        $this->assertNotEmpty(
            $builder,
            'tag builder empty'
        );
    }
}