<?php

namespace App\Http\Controllers\Api;
use App\Models\Media;

class UpdateController
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
            $var['files'] = [$vuf[0]['path'], $vuf[1]['path']];
            unset($vuf['path']);
            return response()->json($var);
        }
        else return response()->json(array(
            'message'      =>  "FORBIDDEN",
        ), 403);

    }
}