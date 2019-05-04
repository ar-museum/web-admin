<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exposition;

class ExpositionController extends Controller
{

    public function index()
    {
        $expositions = Exposition::all();

        foreach($expositions as $expositionKey => $exposition){
            //$exposition = $exposition->toArray();
            unset($exposition['photo']);
            $exposition['photo_path'] = 'museum.lc/uploads/';
        }

        return response()->json($expositions);
    }

    public function indexWithRelationships(){
        $expositions = Exposition::with('museum', 'photo', 'exhibits')->get();

        foreach($expositions as $expositionKey => $exposition){
            //$exposition = $exposition->toArray();
            unset($exposition['photo']);
            $exposition['photo_path'] = 'museum.lc/uploads/';
        }

        return response()->json($expositions);
    }

    public function getData($var){
        $exposition = Exposition::findOrFail($var);
        $exposition->load('photo');

        #$photoPath = $author->photo()->media()->path;

        $exposition = $exposition->toArray();

        unset($exposition['photo']);

        $exposition['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exposition);
    }

    public function getDataWithRelationships($var){
        $exposition = Exposition::findOrFail($var);
        $exposition->load('museum', 'photo', 'exhibits');

        #$photoPath = $author->photo()->media()->path;

        $exposition = $exposition->toArray();

        unset($exposition['photo']);

        $exposition['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exposition);
    }
}