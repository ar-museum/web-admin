<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Museum;

class MuseumController extends Controller
{

    public function index()
    {
        #$museums = Museum::with('expositions')->get()->toArray();
        $museums = Museum::all()->toArray();

        return response()->json($museums);
    }

    public function indexWithRelationships(){
        $museums = Museum::with('expositions')->get()->toArray();

        return response()->json($museums);
    }

    public function getData($var){
        #$museum = Museum::with('expositions')->get()->find($var);

        #$photoPath = $author->photo()->media()->path;

        $museum = Museum::findOrFail($var);

        $museum = $museum->toArray();

        unset($museum['photo']);

        $museum['photo_path'] = 'museum.lc/uploads/';

        return response()->json($museum);
    }

    public function getDataWithRelationships($var){
        $museum = Museum::findOrFail($var);
        $museum->load('expositions');

        $museum = $museum->toArray();

        unset($museum['photo']);

        $museum['photo_path'] = 'museum.lc/uploads/';

        return response()->json($museum);
    }


}