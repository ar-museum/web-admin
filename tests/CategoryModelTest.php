<?php

use App\Models\Category;
use \Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryModelTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test functions.
     *
     * @return void
     */

    public function testCreatingModel()
    {
        define('categoryId', 7);
        define('categoryName', 'Poezie');
        define('categoryStaffId', 1);

        $category = factory(App\Models\Category::class)->make([
            'category_id' => categoryId,
            'name' => categoryName,
            'staff_id' => categoryStaffId
        ]);

        // testing category_id
        $this->assertNotEmpty(
            $category->category_id,
            'category_id is empty'
        );
        $this->assertTrue(
            is_int($category->category_id),
            'category_id is not an integer'
        );
        $this->assertSame(
            categoryId,
            $category->category_id,
            'category_id has not been set properly'
        );

        // testing name
        $this->assertNotEmpty(
            $category->name,
            'name is empty'
        );
        $this->assertTrue(
            is_string($category->name),
            'name is not an string'
        );
        $this->assertSame(
            categoryName,
            $category->name,
            'name has not been set properly'
        );

        // testing staff_id
        $this->assertNotEmpty(
            $category->staff_id,
            'staff_id is empty'
        );
        $this->assertTrue(
            is_int($category->staff_id),
            'staff_id is not an integer'
        );
        $this->assertSame(
            categoryStaffId,
            $category->staff_id,
            'staff_id has not been set properly'
        );
    }

    public function testExhibitRelationships()
    {
        $categories = factory(App\Models\Category::class)->create([
            'name' => 'Roman',
            'staff_id' => 1
        ]);

        $this->assertNull($categories->exhibit()->first());
    }

    public function testLastFive()
    {
        $tempCategories = factory(App\Models\Category::class, 5)->create([
            'name' => 'Roman',
            'staff_id' => 1
        ]);

        $tempCategories = $tempCategories->sortByDesc('category_id');

        $stack = array();

        for ($index = 4; $index >= 0; --$index)
        {
            array_push($stack, $tempCategories->offsetGet($index)->toArray());
        }

        $tempCategories = $stack;

        $this->assertCount(5, $tempCategories);

        $category = new Category();

        $categories = $category->scopeLastFive()->get();

        $this->assertEquals($tempCategories, $categories->toArray());
    }

    public function testFileExistence()
    {
        $this->assertFileExists('app/Models/Category.php');
    }

    public function testInstance()
    {
        $category = new Category();
        $this->assertInstanceOf(Category::class, $category);
    }
}

