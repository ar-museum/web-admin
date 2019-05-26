<?php


use App\Models\ExhibitCategory;

class ExhibitCategoryTest extends TestCase
{
    private $tempExhCat;

    protected function setUp()
    {

        parent::setUp();

        $this->tempExhCat = [
            'exhibit_id' => 1,
            'category_id' => 1,
        ];
    }

    public function testCreatingModel()
    {
        $exhibitcategory = factory(App\Models\ExhibitCategory::class)->make($this->tempExhCat);

        $this->assertEquals($this->tempExhCat['exhibit_id'], $exhibitcategory->exhibit_id);

        $this->assertFileExists('App/Models/ExhibitCategory.php');
        $this->assertInstanceOf(\App\Models\ExhibitCategory::class, new \App\Models\ExhibitCategory());
    }

    public function testCustomAttributes()
    {
        $this->assertSame('exhibit_categories', (new App\Models\ExhibitCategory)->getTable());
        $this->assertSame([
            'exhibit_id',
            'category_id'
        ], (new App\Models\ExhibitCategory)->getFillable());
    }

    public function testSavedRowDatabase()
    {
        factory(App\Models\ExhibitCategory::class, 1)->create($this->tempExhCat);

        $this->seeInDatabase('exhibit_categories', [
            'exhibit_id' => $this->tempExhCat['exhibit_id'],
            'category_id' => $this->tempExhCat['category_id'],
        ]);
    }

    public function testExhibitsRelationships()
    {
        $tempExCat = factory(App\Models\ExhibitCategory::class, 1)->create($this->tempExhCat);

        $this->assertNull($tempExCat->exhibits()->first());

        $exhibit_category = \App\Models\ExhibitCategory::find(1);

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

        $exhibit_category->exhibits()->save($exhibit);

        $exhibits = $exhibit_category->exhibits()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit_category->exhibits()->get());
        $this->assertCount(2, $exhibits->toArray());

        $this->assertEquals($exhibit->toArray(), $exhibit_category->exhibits()->orderBy('exhibit_id', 'desc')->first()->toArray());
    }

    public function testCategoryRelationships()
    {
        $tempExCat = factory(App\Models\ExhibitCategory::class, 1)->create($this->tempExhCat);

        $this->assertNull($tempExCat->category()->first());

        $exhibit_category = \App\Models\ExhibitCategory::find(1);

        $category = new \App\Models\Category([
            'name' => 'Poezie',
            'staff_id' => 1,
        ]);

        $exhibit_category->category()->save($category);

        $categories = $exhibit_category->category()->get();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $exhibit_category->category()->get());
        $this->assertCount(2, $categories->toArray());

        $this->assertEquals($categories->toArray(), $exhibit_category->category()->orderBy('category_id', 'desc')->first()->toArray());
    }


}