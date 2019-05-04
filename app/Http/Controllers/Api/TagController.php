<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{

    public function index()
    {
        #$tags = Tag::with('exhibit')->get()->toArray();
        $tags = Tag::all()->toArray();

        return response()->json($tags);
    }

    public function indexWithRelationships(){
        $tags =  Tag::with('exhibit')->get()->toArray();

        return response()->json($tags);
    }

    public function getData($var){
        $tag = Tag::findOrFail($var);

        #$photoPath = $author->photo()->media()->path;

        $tag = $tag->toArray();

        return response()->json($tag);
    }

    public function getDataWithRelationships($var){
        $tag = Tag::findOrFail($var);

        $tag->load('exhibit');

        #$photoPath = $author->photo()->media()->path;

        $tag = $tag->toArray();

        return response()->json($tag);
    }
}