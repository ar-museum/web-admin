<?php

use App\Models\Audio;

class AudioTest extends TestCase
{
    public function testPathAttribute()
    {
        $media = factory(App\Models\Media::class)->make([
            'path' => 'uploads' . DIRECTORY_SEPARATOR . 'audio' . DIRECTORY_SEPARATOR . 'audioTest.mp3'
        ]);
        $media->save();

        $audio = new Audio();
        $audio->audio_id = $media->media_id;
        $audio->length = 2.5;
        $audio->save();

        $this->assertNotEmpty($audio->getPathAttribute());

        $this->assertEquals('uploads' . DIRECTORY_SEPARATOR . 'audio' . DIRECTORY_SEPARATOR . 'audioTest.mp3', $audio->getPathAttribute());
    }

}
