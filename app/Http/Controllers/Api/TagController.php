<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TagController extends Controller
{

    public function index()
    {
        #$tags = Tag::with('exhibit')->get()->toArray();
        try {
            $tags = Tag::all()->toArray();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista tag-uri in baza de date.'
            ), 404);
        }

        return response()->json($tags);
    }

    public function indexWithRelationships(){
        try{
            $tags =  Tag::with('exhibit')->get()->toArray();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista tag-uri in baza de date.'
            ), 404);
        }

        return response()->json($tags);
    }

    public function getData($var){
        try {
            $tag = Tag::findOrFail($var);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest tag in baza de date.'
            ), 404);
        }
        #$photoPath = $author->photo()->media()->path;

        $tag = $tag->toArray();

        return response()->json($tag);
    }

    public function getDataWithRelationships($var){
        try {
            $tag = Tag::findOrFail($var);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest tag in baza de date.'
            ), 404);
        }

        $tag->load('exhibit');

        #$photoPath = $author->photo()->media()->path;

        $tag = $tag->toArray();

        return response()->json($tag);
    }
}