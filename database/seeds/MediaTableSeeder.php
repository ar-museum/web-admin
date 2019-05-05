<?php

use Illuminate\Database\Seeder;
use wapmorgan\Mp3Info\Mp3Info;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        /** uploads all IMAGES from public uploads*/
        $full_path_photo = public_path() . DIRECTORY_SEPARATOR . 'uploads\photo';
        $images = glob($full_path_photo . DIRECTORY_SEPARATOR . "*.{jpg,jpeg,gif,png,bmp}", GLOB_BRACE);

        foreach ($images as $img_name) {
            $info_image = getimagesize($img_name);

            $path_img = 'uploads\photo' . DIRECTORY_SEPARATOR . basename($img_name);

            $media_id = factory(App\Models\Media::class)->create(['path' => $path_img ])->media_id;

            factory(App\Models\Photo::class)->create([
                'photo_id' => $media_id,
                'width' => $info_image[0],
                'height' => $info_image[1]
            ]);
        }

        /** uploads all AUDIOS from public uploads*/
        $full_path_audio = public_path() . DIRECTORY_SEPARATOR . 'uploads\audio';
        $audios = glob($full_path_audio . DIRECTORY_SEPARATOR . "*.{mp3,wav}", GLOB_BRACE);

        foreach ($audios as $audio_name) {
            $audio = new Mp3Info($audio_name);

            $path_audio = 'uploads\audio' . DIRECTORY_SEPARATOR . basename($audio_name);

            $media_id = factory(App\Models\Media::class)->create(['path' => $path_audio ])->media_id;

            factory(App\Models\Audio::class)->create([
                'audio_id' => $media_id,
                'length' => round($audio->duration,1)
            ]);
        }

        /** uploads all VIDEOS from public uploads*/
        $full_path_video = public_path() . DIRECTORY_SEPARATOR . 'uploads\video';
        $videos = glob($full_path_video . DIRECTORY_SEPARATOR . "*.{mp4,avi}", GLOB_BRACE);

        foreach ($videos as $video_name) {
            $video = new Mp3Info($video_name);

            $path_video = 'uploads\video' . DIRECTORY_SEPARATOR . basename($video_name);

            $media_id = factory(App\Models\Media::class)->create(['path' => $path_video ])->media_id;

            factory(App\Models\Video::class)->create([
                'video_id' => $media_id,
                'length' => 2 //round($video->duration,1)
            ]);
        }
    }
}
