<?php

namespace App\Http\Controllers\Web;

use App\Models\Media;
use App\Models\Photo;
use App\Models\Audio;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function index()
    {
        return view('dashboard.media', [
            'medias' => Media::lastFive()->get(),
            'medias_no' => Media::all()->count(),
            'photos' => Photo::all(),
            'audios' => Audio::all(),
            'videos' => Video::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.media');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'photo' => 'required',
            'photo_width' => 'required',
            'photo_height' => 'required'
        ]);
        $media = new Media();
        $media->path = '/resources/uploads/Media/Photo/' . $request->get('photo');
        $media->save();

        $photo = new Photo();
        $photo->photo_id = $media->media_id;
        $photo->width = $request->get('photo_width');
        $photo->height = $request->get('photo_height');

        $photo->save();
        return redirect('/media')->with('success','Media adaugata!');
    }
}
