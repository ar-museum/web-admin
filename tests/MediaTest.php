<?php

use App\Models\Exhibit;
use App\Models\Media;

class MediaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
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


        /** photo */
        $photo = factory(App\Models\Photo::class)->make([
            'width' => '10',
            'height' => '20'
        ]);
        $this->assertLessThan(10000000000, $photo->width);
        $this->assertLessThan(10000000000, $photo->height);
        $this->assertNotEmpty($photo->width);
        $this->assertNotEquals('', $photo->width);
        $this->assertEquals('10', $photo->width);
        $this->assertNotEmpty($photo->height);
        $this->assertNotEquals('', $photo->height);
        $this->assertEquals('20', $photo->height);
        /** Model creation Photo*/
        $this->assertFileExists('App/Models/Photo.php');
        $this->assertInstanceOf(Photo::class, new Photo);


        /** audio */
        $audio = factory(App\Models\Audio::class)->make([
            'length' => '2.5'
        ]);
        $this->assertEquals('2.5', $audio->length);
        $this->assertNotEmpty($audio->length);
        /** Model creation Audio*/
        $this->assertFileExists('App/Models/Audio.php');
        $this->assertInstanceOf(Audio::class, new Audio);


        /** video */
        $video = factory(App\Models\Video::class)->make([
            'length' => '3.47'
        ]);
        $this->assertEquals('3.47', $video->length);
        $this->assertNotEmpty($video->length);
        /** Model creation Video*/
        $this->assertFileExists('App/Models/Video.php');
        $this->assertInstanceOf(Video::class, new Video);
    }
}
