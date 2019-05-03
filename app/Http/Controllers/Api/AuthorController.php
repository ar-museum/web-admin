<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::with('photo')->get();

        foreach($authors as $author){
            $author->toArray();
            unset($author['photo']);
            $author['photo'] = 'museum.lc/uploads/';
        }

        return response()->json($authors);
    }

    public function getData($var){
        $author = Author::with('photo')->get()->find($var);

        #$photoPath = $author->photo()->media()->path;

        $author = $author->toArray();

        unset($author['photo']);

        $author['photo_path'] = 'museum.lc/uploads/';

        return response()->json($author);
    }
}