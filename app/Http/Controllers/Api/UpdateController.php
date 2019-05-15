<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dragndrop;
use App\Models\Museum;
use App\Models\Vuforia;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateController extends Controller
{
    public function index()
    {

        if (empty(request()->has("version")) && empty(request()->has("museum_id"))) {
            return response()->json(array(
                'mesage' => "FORBIDDEN",
            ), 403);
        }

        $version = request()->get("version");
        $museum_id = request()->get('museum_id');

        $vuf = Vuforia::select(['vuforia_files.path' , 'vuforia.museum_id'])
            ->join('vuforia_files', 'vuforia.file_id', '=', 'vuforia_files.file_id')
            ->where('vuforia.museum_id', $museum_id)
            ->where('vuforia.version', $version)
            ->orderBy("version", "DESC")->get()->toArray();

        if (count($vuf[0]['path'])) {
            $vuf[0]['path'] = str_replace('\\', '/', $vuf[0]['path']);
            $vuf[1]['path'] = str_replace('\\', '/', $vuf[1]['path']);
            $var['files'] = [$vuf[0]['path'], $vuf[1]['path']];
            unset($vuf['path']);
            return response()->json($var);
        } else return response()->json(array(
            'message' => "Nu exista nicio linie in baza de date.",
        ), 403);
    }

    public function drag($id)
    {
        try {
            $test = Museum::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'mesaj' => 'Nu exista acest muzeu in baza de date.'
            ), 404);
        }

        $museums = Dragndrop::where('museum_id', $id)->get();

        foreach ($museums as $var => $museum) {
            unset($museum['museum_id']);
            unset($museum['dragndrop_id']);
            $museum['path'] = str_replace('\\', '/', $museum['path']);
        }

        $variable['photos'] = $museums->toArray();

        return response()->json($variable);
    }
}