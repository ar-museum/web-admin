<?php

use App\Models\Audio;
use App\Models\Category;
use App\Models\Exhibit;
use App\Models\Media;
use App\Models\Photo;
use App\Models\Video;

class MediaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    protected $media,$photo,$audio,$video,$exhibit;

    public function testMediaModel()
    {
        /** media */
        $media = factory(App\Models\Media::class)->make([
            'path' => '/resources/Media/Photo/photo1.jpg',
        ]);

        $this->assertLessThan(255, strlen($media->path));
        $this->assertNotEmpty($media->path);
        $this->assertEquals('/resources/Media/Photo/photo1.jpg', $media->path);
        $this->assertNotEquals('', $media->path);
        $this->assertTrue(true, is_int($media->media_id));
        $this->assertStringStartsWith('/resources/Media/Photo/', $media->path);
        $this->assertFinite($media->media_id);
        /** Model creation Media*/
        $this->assertFileExists('App/Models/Media.php');
        $this->assertInstanceOf(Media::class, new Media);
    }

    public function testPhotoRelationships()
    {
        /** photo */
        $photo = factory(App\Models\Photo::class)->make([
            'width' => 10,
            'height' => 20
        ]);
        $this->assertNull($photo->media()->first());
        $this->assertLessThan(10000000000, $photo->width);
        $this->assertLessThan(10000000000, $photo->height);
        $this->assertNotEmpty($photo->width);
        $this->assertNotEquals('', $photo->width);
        $this->assertEquals(10, $photo->width);
        $this->assertNotEmpty($photo->height);
        $this->assertNotEquals(null, $photo->height);
        $this->assertEquals(20, $photo->height);
        /** Model creation Photo*/
        $this->assertFileExists('App/Models/Photo.php');
        $this->assertInstanceOf(Photo::class, new Photo);
    }

    public function testAudioRelantionships()
    {
        /** audio */
        $audio = factory(App\Models\Audio::class)->make([
            'length' => 2.5
        ]);
        $this->assertNull($audio->media()->first());
        $this->assertEquals(2.5, $audio->length);
        $this->assertNotEmpty($audio->length);
        /** Model creation Audio*/
        $this->assertFileExists('App/Models/Audio.php');
        $this->assertInstanceOf(Audio::class, new Audio);
    }

    public function testVideoRelantionships()
    {
        /** video */
        $video = factory(App\Models\Video::class)->make([
            'length' => 3.47
        ]);
        $this->assertNull($video->media()->first());
        $this->assertEquals(3.47, $video->length);
        $this->assertNotEmpty($video->length);
        /** Model creation Video*/
        $this->assertFileExists('App/Models/Video.php');
        $this->assertInstanceOf(Video::class, new Video);
    }

    public function testExhibitRelationships()
    {
        /** creating exhibit */
        $exhibit = new Exhibit([
            'title' => $params['title'] ?? str_random(10),
            'short_description' => $params['short_description'] ?? 'So deep!',
            'description' => $params['description'] ?? 'Cea mai splendida poezie ever!',
            'start_year' => $params['start_year'] ?? '1873',
            'end_year' => $params['end_year'] ?? '2019',
            'size' => $params['size'] ?? '20x30cm',
            'location' => $params['location'] ?? 'Iasi',
            'author_id' => $params['author_id'] ?? 1,
            'exposition_id' => $params['exposition_id'] ?? 1,
            'staff_id' => $params['staff_id'] ?? 1,
            'audio_id' => $params['audio_id'] ?? 2,
            'photo_id' => $params['photo_id'] ?? 1,
            'video_id' => $params['video_id'] ?? 3,
        ]);

        /** photo */
        $photo = factory(App\Models\Photo::class)->make([
            'width' => 10,
            'height' => 20
        ]);
        $this->assertNull($photo->exhibit()->first());

        /** audio */
        $audio = factory(App\Models\Audio::class)->make([
            'length' => 2.5
        ]);
        $this->assertNull($audio->exhibit()->first());

        /** video */
        $video = factory(App\Models\Video::class)->make([
            'length' => 3.47
        ]);
        $this->assertNull($video->exhibit()->first());
    }

    public function testLastFive()
    {/*
        $tempMedias = factory(App\Models\Media::class)->make([
            'path' => '/resources/Media/Photo/photo1.jpg',
        ]);
        $tempMedias = $tempMedias->sortByDesc('media_id');

        $stack = array();

        for ($index = 4; $index >= 0; --$index)
        {
            array_push($stack, $tempMedias->offsetGet($index)->toArray());
        }

        $tempMedias = $stack;

        $this->assertCount(5, $tempMedias);

        $media_1 = new Media();

        $medias = $media_1->scopeLastFive()->get();

        $this->assertEquals($tempMedias, $medias->toArray());*/

        $tempMedias = factory(App\Models\Media::class)->make([
            'path' => '/resources/Media/Photo/photo1.jpg',
        ])->orderBy('media_id', 'DESC');

        $stack = array();
        for ($index = 4; $index >= 0; --$index)
        {
            array_push($stack, $tempMedias->offsetGet($index)->toArray());
        }

        $tempMedias = $stack;

        $this->assertCount(5, $tempMedias);

        $medias = Media::lastFive()->get();

        $this->assertEquals($tempMedias, $medias->toArray());

    }

}
