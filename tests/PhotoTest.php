<?php

use App\Models\Photo;

class PhotoTest extends TestCase
{
    public function testPathAttribute()
    {
        $media = factory(App\Models\Media::class)->make([
            'path' => 'uploads' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR . 'testPhoto5.jpg'
        ]);
        $media->save();

        $photo = new Photo();
        $photo->photo_id = $media->media_id;
        $photo->width = 200;
        $photo->height = 300;
        $photo->save();

        $this->assertNotEmpty($photo->getPathAttribute());

        $this->assertEquals('uploads' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR . 'testPhoto5.jpg', $photo->getPathAttribute());
    }

}
