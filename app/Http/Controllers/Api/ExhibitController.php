<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Exhibit;
use App\Models\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExhibitController extends Controller
{

    public function index()
    {
        #$exhibits = Exhibit::with('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio')->get();
        try {
            $exhibits = Exhibit::with('photo', 'audio')->get();
        }  catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista exponate in baza de date.'
            ), 404);
        }

        foreach ($exhibits as $exhibitKey =>$exhibit) {
            //$exhibit = $exhibit->toArray();
            $photo = new Photo();
            $photo->photo_id = $exhibit['photo_id'];
            $path = $photo->getPathAttribute();

            $path = str_replace('\\', '/', $path);

            unset($exhibit['photo']);
            $exhibit['photo_path'] = $path;

            $audio = new Audio();
            $audio->audio_id = $exhibit['audio_id'];
            $path_audio = $audio->getPathAttribute();

            $path_audio = str_replace('\\', '/', $path_audio);
            unset($exhibit['audio']);

            $exhibit['audio_path'] = $path_audio;
        }

        return response()->json($exhibits);
    }

    public function indexWithRelationships(){
        try {
            $exhibits = Exhibit::with('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio')->get();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista exponate in baza de date.'
            ), 404);
        }

        foreach ($exhibits as $exhibitKey =>$exhibit) {
            //$exhibit = $exhibit->toArray();
            $photo = new Photo();
            $photo->photo_id = $exhibit['photo_id'];
            $path = $photo->getPathAttribute();

            $path = str_replace('\\', '/', $path);

            unset($exhibit['photo']);

            $exhibit['photo_path'] = $path;

            $audio = new Audio();
            $audio->audio_id = $exhibit['audio_id'];
            $path_audio = $audio->getPathAttribute();

            $path_audio = str_replace('\\', '/', $path_audio);
            unset($exhibit['audio']);

            $exhibit['audio_path'] = $path_audio;
        }

        return response()->json($exhibits);
    }

    public function getData($var){
        try {
            $exhibit = Exhibit::findOrFail($var);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest exponat in baza de date.'
            ), 404);
        }
        $exhibit->load('photo', 'audio');

        #$photoPath = $author->photo()->media()->path;

        $audio = new Audio();
        $audio->audio_id = $exhibit['audio_id'];
        $path_audio = $audio->getPathAttribute();

        $path_audio = str_replace('\\', '/', $path_audio);
        unset($exhibit['audio']);

        $exhibit['audio_path'] = $path_audio;

        $exhibit = $exhibit->toArray();

        $photo = new Photo();
        $photo->photo_id = $exhibit['photo'];
        $path = $photo->getPathAttribute();

        $path = str_replace('\\', '/', $path);

        unset($exhibit['photo']);

        $exhibit['photo_path'] = $path;

        return response()->json($exhibit);
    }

    public function getDataWithRelationships($var){
        try {
            $exhibit = Exhibit::findOrFail($var);
        }  catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest exponat in baza de date.'
            ), 404);
        }

        $exhibit->load('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio');

        #$photoPath = $author->photo()->media()->path;

        $audio = new Audio();
        $audio->audio_id = $exhibit['audio_id'];
        $path_audio = $audio->getPathAttribute();

        $path_audio = str_replace('\\', '/', $path_audio);
        unset($exhibit['audio']);

        $exhibit['audio_path'] = $path_audio;

        $exhibit = $exhibit->toArray();

        $photo = new Photo();
        $photo->photo_id = $exhibit['photo_id'];
        $path = $photo->getPathAttribute();

        $path = str_replace('\\', '/', $path);

        unset($exhibit['photo']);

        $exhibit['photo_path'] = $path;

        return response()->json($exhibit);
    }
}