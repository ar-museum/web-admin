<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exhibit;

class ExhibitController extends Controller
{

    public function index()
    {
        $exhibits = Exhibit::with('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio')->get();

        foreach($exhibits as $exhibit){
            $exhibit->toArray();
            unset($exhibit['photo']);
            $exhibit['photo'] = 'museum.lc/uploads/';
        }

        return response()->json($exhibits);
    }

    public function getData($var){
        $exhibit = Exhibit::with('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio')->get()->find($var);

        #$photoPath = $author->photo()->media()->path;

        $exhibit = $exhibit->toArray();

        unset($exhibit['photo']);

        $exhibit['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exhibit);
    }
}