<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Museum;

class MuseumController extends Controller
{

    public function index()
    {
        $museums = Museum::with('expositions')->get()->toArray();

        return response()->json($museums);
    }

    public function getData($var){
        $museum = Museum::with('expositions')->get()->find($var);

        #$photoPath = $author->photo()->media()->path;

        $museum = $museum->toArray();

        unset($museum['photo']);

        $museum['photo_path'] = 'museum.lc/uploads/';

        return response()->json($museum);
    }
}