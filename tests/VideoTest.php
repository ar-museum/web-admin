<?php

use App\Models\Video;

class VideoTest extends TestCase
{
    public function testPathAttribute()
    {
        $media = factory(App\Models\Media::class)->make([
            'path' => 'https://youtu.be/fwmmXK2NwuQ'
        ]);
        $media->save();

        $video = new Video();
        $video->video_id = $media->media_id;
        $video->length = 3.2;
        $video->save();

        $this->assertNotEmpty($video->getPathAttribute());

        $this->assertEquals('https://youtu.be/fwmmXK2NwuQ', $video->getPathAttribute());
    }

}
