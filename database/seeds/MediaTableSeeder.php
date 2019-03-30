<?php

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //insert data

        //insert first element
        $id = DB::table('media')->insertGetId([
            'path' => '~/Resources/Media/photo1.jpg'
        ]);

        DB::table('photo')->insert([
            'photo_id' => $id,
            'width' => '10',
            'height' => '20',
        ]);

        //insert second element
        $id = DB::table('media')->insertGetId([
            'path' => '~/Resources/Media/audio1.mp3'
        ]);

        DB::table('audio')->insert([
            'audio_id' => $id,
            'length' => '2.5'
        ]);

        //insert third element
        $id = DB::table('media')->insertGetId([
            'path' => '~/Resources/Media/video1.mp4'
        ]);

        DB::table('video')->insert([
            'video_id' => $id,
            'length' => '5.2'
        ]);
    }
}
