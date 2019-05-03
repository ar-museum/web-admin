<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exposition;

class ExpositionController extends Controller
{

    public function index()
    {
        $expositions = Exposition::with('museum', 'photo', 'exhibits')->get();

        foreach($expositions as $exposition){
            $exposition->toArray();
            unset($exposition['photo']);
            $exposition['photo'] = 'museum.lc/uploads/';
        }

        return response()->json($expositions);
    }

    public function getData($var){
        $exposition = Exposition::with('museum', 'photo', 'exhibits')->get()->find($var);

        #$photoPath = $author->photo()->media()->path;

        $exposition = $exposition->toArray();

        unset($exposition['photo']);

        $exposition['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exposition);
    }
}