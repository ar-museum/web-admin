<?php

use App\Models\Exhibit;
use App\Models\Category;
use App\Models\ExhibitCategory;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExhibitCategoryModelTest extends TestCase
{
    use DatabaseTransactions;

    private $exhibit;
    private $category;

    protected function setUp()
    {
        parent::setUp();

        $this->exhibit = factory(Exhibit::class)->create([
            'short_description' => 'Test description!',
            'description' => 'There is a long long-long description',
            'start_year' => '1998',
            'end_year' => '2019',
            'size' => '21x22cm',
            'location' => 'Vaslui'
        ]);

        $this->category = factory(Category::class)->create([
            'name' => 'Statui'
        ]);
    }

    public function testCreatingModel()
    {
        $exhibitCategory = factory(ExhibitCategory::class)->make([
            'exhibit_id' => $this->exhibit->exhibit_id,
            'category_id' => $this->category->category_id
        ]);

        $this->assertNotNull(
            $exhibitCategory->exhibit_id,
            'exhibit_id is null'
        );

        $this->assertNotEmpty(
            $exhibitCategory->exhibit_id,
            'exhibit_id is empty'
        );

        $this->assertTrue(
            is_int($exhibitCategory->exhibit_id),
            'exhibit_id is not an integer'
        );

        $this->assertNotNull(
            $exhibitCategory->category_id,
            'category_id is null'
        );

        $this->assertNotEmpty(
            $exhibitCategory->category_id,
            'category_id is empty'
        );

        $this->assertTrue(
            is_int($exhibitCategory->category_id),
            'category_id is not an integer'
        );
    }

    public function testExhibitRelationships()
    {
        $exhibitCategory = factory(ExhibitCategory::class)->make([
            'exhibit_id' => $this->exhibit->exhibit_id,
            'category_id' => $this->category->category_id
        ]);

        $builder = $exhibitCategory->exhibit();

        $this->assertNotEmpty(
            $builder,
            'exhibit builder empty'
        );
    }

    public function testCategoryRelationships()
    {
        $exhibitCategory = factory(ExhibitCategory::class)->make([
            'exhibit_id' => $this->exhibit->exhibit_id,
            'category_id' => $this->category->category_id
        ]);

        $builder = $exhibitCategory->category();

        $this->assertNotEmpty(
            $builder,
            'category builder empty'
        );
    }
}