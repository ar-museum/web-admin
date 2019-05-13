<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dragndrop;
use App\Models\Media;
use App\Models\Museum;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateController extends Controller
{
    public function index()
    {

        if(empty(request()->has("version"))){
            return response()->json(array(
                'mesage'      =>  "FORBIDDEN",
            ), 403);
        }

        $version = request()->get("version");

        $vuf = Media::select(['path'])
            ->join('vuforia', 'vuforia.file_id', '=', 'media.media_id')
            ->where('vuforia.version', $version)
            ->orderBy("version", "ASC")->get()->toArray();

        if(count($vuf)) {
            $vuf[0]['path'] = str_replace('\\', '/', $vuf[0]['path']);
            $vuf[1]['path'] = str_replace('\\', '/', $vuf[1]['path']);
            $var['files'] = [$vuf[0]['path'], $vuf[1]['path']];
            unset($vuf['path']);
            return response()->json($var);
        }
        else return response()->json(array(
            'message'      =>  "FORBIDDEN",
        ), 403);
    }

    public function drag($id){
        try {
            $test = Museum::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'mesaj'   =>  'Nu exista acest muzeu in baza de date.'
            ), 404);
        }

        $museums = Dragndrop::where('museum_id', $id)->get();

        foreach($museums as $var => $museum) {
            unset($museum['museum_id']);
            unset($museum['dragndrop_id']);
            $museum['path'] = str_replace('\\', '/', $museum['path']);
        }

        $variable['photos'] = $museums->toArray();

        return response()->json($variable);
    }
}