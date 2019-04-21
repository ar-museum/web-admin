<?php

namespace App\Http\Controllers\Web;

use App\Models\Media;
use App\Models\Photo;
use App\Models\Audio;
use App\Models\Video;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function index()
    {
        return view('media.view', [
            'medias' => Media::all(),
            'medias_no' => Media::all()->count(),
            'photos' => Photo::all(),
            'audios' => Audio::all(),
            'videos' => Video::all(),
        ]);
    }

    public function create()
    {
        return view('media.view');
    }

    public function store_photo()
    {
        $this->validate(request(),[
            'photo' => 'required'
        ]);
        $media = new Media();
        $media->path = '/resources/uploads/Media/Photo/' . request()->get('photo');
        $media->save();

        $photo = new Photo();
        $photo->photo_id = $media->media_id;
        $photo->width = 0;
        $photo->height = 0;

        $photo->save();
        return redirect('/media')->with('success','Fotografie adaugata!');
    }

    public function store_audio()
    {
        $this->validate(request(),[
            'audio' => 'required'
        ]);
        $media = new Media();
        $media->path = '/resources/uploads/Media/Audio/' . request()->get('audio');
        $media->save();

        $audio = new Audio();
        $audio->audio_id = $media->media_id;
        $audio->length = 2.3;

        $audio->save();
        return redirect('/media')->with('success','Audio adaugat!');
    }

    public function store_video()
    {
        $this->validate(request(),[
            'video' => 'required'
        ]);
        $media = new Media();
        $media->path = '/resources/uploads/Media/Video/' . request()->get('video');
        $media->save();

        $video = new Video();
        $video->audio_id = $media->media_id;
        $video->length = 3.5;

        $video->save();
        return redirect('/media')->with('success','Video adaugat!');
    }

    public function destroy($media_id)
    {
        try {
            $media = Media::findOrFail($media_id);
            $media->delete();
        } catch (\Exception $e) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('media');
            }

            return error($e->getMessage());
        }

        if (request()->getMethod() == 'GET') {
            return redirect()->route('media', ['media_id' => $media_id]);
        }

        return response()->json(['message' => 'Resursa media ' . $media->path . ' a fost stearsa cu succes!']);
    }
}
