<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;

class IndexController extends Controller
{

    public function index()
    {
        $author = Author::find(1)->with('photo')->get();

        #$photoPath = $author->photo()->media()->path;

        $author = $author->toArray();

        unset($author[0]['photo']);

        $author[0]['photo_path'] = 'museum.lc/uploads/';

        return response()->json($author);
    }
}