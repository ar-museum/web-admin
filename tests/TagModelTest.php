<?php

use App\Models\Tag;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagModelTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test functions.
     *
     * @return void
     */

    public function testCreatingModel()
    {
        define('tagId', 7);
        define('tagName', 'romantism');
        define('tagStaffId', 1);

        $tag = factory(Tag::class)->make([
            'tag_id' => tagId,
            'name' => tagName,
            'staff_id' => tagStaffId
        ]);

        // testing tag_id
        $this->assertNotEmpty(
            $tag->tag_id,
            'tag_id is empty'
        );
        $this->assertTrue(
            is_int($tag->tag_id),
            'tag_id is not an integer'
        );
        $this->assertSame(
            tagId,
            $tag->tag_id,
            'tag_id has not been set properly'
        );

        // testing name
        $this->assertNotEmpty(
            $tag->name,
            'name is empty'
        );
        $this->assertTrue(
            is_string($tag->name),
            'name is not an string'
        );
        $this->assertSame(
            tagName,
            $tag->name,
            'name has not been set properly'
        );

        // testing staff_id
        $this->assertNotEmpty(
            $tag->staff_id,
            'staff_id is empty'
        );
        $this->assertTrue(
            is_int($tag->staff_id),
            'staff_id is not an integer'
        );
        $this->assertSame(
            tagStaffId,
            $tag->staff_id,
            'staff_id has not been set properly'
        );
    }

    public function testExhibitRelationships()
    {
        $tags = factory(Tag::class)->create([
            'name' => 'epigrame-noi',
            'staff_id' => 1
        ]);

        $this->assertNull($tags->exhibit()->first());
    }

    public function testLastFive()
    {
        $tempTags = factory(Tag::class, 5)->create([
            'name' => 'cel-mai-citit',
            'staff_id' => 1
        ]);

        $tempTags = $tempTags->sortByDesc('tag_id');

        $stack = array();

        for ($index = 4; $index >= 0; --$index)
        {
            array_push($stack, $tempTags->offsetGet($index)->toArray());
        }

        $tempTags = $stack;

        $this->assertCount(5, $tempTags);

        $tag = new Tag();

        $tags = $tag->scopeLastFive()->get();

        $this->assertEquals($tempTags, $tags->toArray());
    }

    public function testFileExistence()
    {
        $this->assertFileExists('app/Models/Tag.php');
    }

    public function testInstance()
    {
        $tag = new Tag();
        $this->assertInstanceOf(Tag::class, $tag);
    }
}