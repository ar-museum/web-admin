<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exhibit;

class ExhibitController extends Controller
{

    public function index()
    {
        #$exhibits = Exhibit::with('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio')->get();
        $exhibits = Exhibit::with('photo')->get();

        foreach ($exhibits as $exhibitKey =>$exhibit) {
            //$exhibit = $exhibit->toArray();
            unset($exhibit['photo']);
            $exhibit['photo_path'] = 'museum.lc/uploads';
        }

        return response()->json($exhibits);
    }

    public function indexWithRelationships(){
        $exhibits = Exhibit::with('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio')->get();

        foreach ($exhibits as $exhibitKey =>$exhibit) {
            //$exhibit = $exhibit->toArray();
            unset($exhibit['photo']);
            $exhibit['photo_path'] = 'museum.lc/uploads';
        }

        return response()->json($exhibits);
    }

    public function getData($var){
        $exhibit = Exhibit::findOrFail($var);
        $exhibit->load('photo');

        #$photoPath = $author->photo()->media()->path;

        $exhibit = $exhibit->toArray();

        unset($exhibit['photo']);

        $exhibit['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exhibit);
    }

    public function getDataWithRelationships($var){
        $exhibit = Exhibit::findOrFail($var);
        $exhibit->load('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio');

        #$photoPath = $author->photo()->media()->path;

        $exhibit = $exhibit->toArray();

        unset($exhibit['photo']);

        $exhibit['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exhibit);
    }
}