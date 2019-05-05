<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exposition;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExpositionController extends Controller
{

    public function index()
    {
        try {
            $expositions = Exposition::all();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista expozitii in baza de date.'
            ), 404);
        }

        foreach($expositions as $expositionKey => $exposition){
            //$exposition = $exposition->toArray();
            unset($exposition['photo']);
            $exposition['photo_path'] = 'museum.lc/uploads/';
        }

        return response()->json($expositions);
    }

    public function indexWithRelationships(){
        try {
            $expositions = Exposition::with('museum', 'photo', 'exhibits')->get();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista expozitii in baza de date.'
            ), 404);
        }

        foreach($expositions as $expositionKey => $exposition){
            //$exposition = $exposition->toArray();
            unset($exposition['photo']);
            $exposition['photo_path'] = 'museum.lc/uploads/';
        }

        return response()->json($expositions);
    }

    public function getData($var){
        try {
            $exposition = Exposition::findOrFail($var);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest exponat in baza de date.'
            ), 404);
        }

        $exposition->load('photo');

        #$photoPath = $author->photo()->media()->path;

        $exposition = $exposition->toArray();

        unset($exposition['photo']);

        $exposition['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exposition);
    }

    public function getDataWithRelationships($var){
        try {
            $exposition = Exposition::findOrFail($var);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest exponat in baza de date.'
            ), 404);
        }

        $exposition->load('museum', 'photo', 'exhibits');

        #$photoPath = $author->photo()->media()->path;

        $exposition = $exposition->toArray();

        unset($exposition['photo']);

        $exposition['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exposition);
    }
}