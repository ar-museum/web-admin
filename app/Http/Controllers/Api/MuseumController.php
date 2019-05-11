<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Museum;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MuseumController extends Controller
{

    public function index()
    {
        #$museums = Museum::with('expositions')->get()->toArray();
        try {
            $museums = Museum::all()->toArray();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista muzee in baza de date.'
            ), 404);
        }

        return response()->json($museums);
    }

    public function indexWithRelationships(){
        try {
            $museums = Museum::with('expositions')->get()->toArray();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista muzee in baza de date.'
            ), 404);
        }

        return response()->json($museums);
    }

    public function getData($var){
        #$museum = Museum::with('expositions')->get()->find($var);

        #$photoPath = $author->photo()->media()->path;

        try {
            $museum = Museum::findOrFail($var);
        }catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest muzeu in baza de date.'
            ), 404);
        }

        $museum = $museum->toArray();

        return response()->json($museum);
    }

    public function getDataWithRelationships($var){
        try {
            $museum = Museum::findOrFail($var);
        }catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest muzeu in baza de date.'
            ), 404);
        }

        $museum->load('expositions');

        $museum = $museum->toArray();

        unset($museum['photo']);

        $museum['photo_path'] = 'museum.lc/uploads/';

        return response()->json($museum);
    }


}