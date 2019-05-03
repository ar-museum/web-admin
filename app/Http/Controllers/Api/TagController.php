<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::with('exhibit')->get()->toArray();

        return response()->json($tags);
    }

    public function getData($var){
        $tag = Tag::with('exhibit')->get()->find($var);

        #$photoPath = $author->photo()->media()->path;

        $tag = $tag->toArray();

        return response()->json($tag);
    }
}