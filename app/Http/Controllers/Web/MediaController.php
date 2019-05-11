<?php

namespace App\Http\Controllers\Web;

use App\Models\Media;
use App\Models\Photo;
use App\Models\Audio;
use App\Models\photoGames;
use App\Models\Video;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
//use wapmorgan\Mp3Info\Mp3Info;

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

    //store media game
    public function store_photo(Request $request)
    {
        $this->validate($request,[
            'photo' => 'required',
            'title' => 'required'
        ]);

        if (request()->hasFile('photo')) {
            $photo        = $request->file('photo');
            $new_filename = md5(time() . $photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();

            try {
                $photo->move(public_path('uploads' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR . 'games' .
                    DIRECTORY_SEPARATOR), $new_filename);
            } catch (FileException $e) {
                return redirect()->back()->withErrors(['photo' => '* ' . $e->getMessage()])->withInput();
            }
        }

        $media = new Media();
        $media->path = 'uploads' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR . 'games' . DIRECTORY_SEPARATOR . $new_filename;

        $full_path = public_path() . DIRECTORY_SEPARATOR . $media->path ;
        $media->save();

        $photo = new photoGames();
        $photo->photo_id = $media->media_id;

        $info_image = getimagesize($full_path);
        $photo->width = $info_image[0];
        $photo->height = $info_image[1];
        $photo->title = $request->get('title');

        $photo->save();
        return redirect('/media')->with('success','Fotografie adaugata!');
    }

    public function store_audio(Request $request)
    {
        $this->validate($request,[
            'audio' => 'required'
        ]);

        if (request()->hasFile('audio')) {
            $audio        = $request->file('audio');
            $new_filename = md5(time() . $audio->getClientOriginalName()) . '.' . $audio->getClientOriginalExtension();

            try {
                $audio->move(public_path('uploads' . DIRECTORY_SEPARATOR . 'audio' .
                    DIRECTORY_SEPARATOR), $new_filename);
            } catch (FileException $e) {
                return redirect()->back()->withErrors(['audio' => '* ' . $e->getMessage()])->withInput();
            }
        }

        $media = new Media();
        $media->path = 'uploads\audio' . DIRECTORY_SEPARATOR . $new_filename;
        $media->save();

        $audio = new Audio();
        $audio->audio_id = $media->media_id;

        $full_path = public_path() . DIRECTORY_SEPARATOR . $media->path ;

        //$mp3file = new Mp3Info($full_path);

        //$audio->length = $mp3file->getDurationEstimate();

        $audio->length = 0;
        $audio->save();
        return redirect('/media')->with('success','Audio adaugat!');
    }

    public function store_video(Request $request)
    {
        $this->validate($request,[
            'yt_link' => 'required'
        ]);

        $media = new Media();
        $media->path = $request->get('yt_link');
        $media->save();

        $video = new Video();
        $video->video_id = $media->media_id;
        $video->length = 0;

        $video->save();
        return redirect('/media')->with('success','Video adaugat!');
    }

    public function destroy($media_id)
    {
        try {
            $media = Media::findOrFail($media_id);
            $media->delete();
        }
        catch (Exception $e) {
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
