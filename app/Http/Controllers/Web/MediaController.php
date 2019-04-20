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
        return view('dashboard.media.blade.php');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'path_media' => 'required'
        ]);
        $media = new Media();
        $media->path = $request->get('path-media');

        $media->save();
        return redirect('/media')->with('success','Media adaugata!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
