<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exhibit;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExhibitController extends Controller
{

    public function index()
    {
        #$exhibits = Exhibit::with('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio')->get();
        try {
            $exhibits = Exhibit::with('photo')->get();
        }  catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista exponate in baza de date.'
            ), 404);
        }

        foreach ($exhibits as $exhibitKey =>$exhibit) {
            //$exhibit = $exhibit->toArray();
            unset($exhibit['photo']);
            $exhibit['photo_path'] = 'museum.lc/uploads';
        }

        return response()->json($exhibits);
    }

    public function indexWithRelationships(){
        try {
            $exhibits = Exhibit::with('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio')->get();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista exponate in baza de date.'
            ), 404);
        }

        foreach ($exhibits as $exhibitKey =>$exhibit) {
            //$exhibit = $exhibit->toArray();
            unset($exhibit['photo']);
            $exhibit['photo_path'] = 'museum.lc/uploads';
        }

        return response()->json($exhibits);
    }

    public function getData($var){
        try {
            $exhibit = Exhibit::findOrFail($var);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest exponat in baza de date.'
            ), 404);
        }
        $exhibit->load('photo');

        #$photoPath = $author->photo()->media()->path;

        $exhibit = $exhibit->toArray();

        unset($exhibit['photo']);

        $exhibit['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exhibit);
    }

    public function getDataWithRelationships($var){
        try {
            $exhibit = Exhibit::findOrFail($var);
        }  catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest exponat in baza de date.'
            ), 404);
        }

        $exhibit->load('photo', 'authors', 'expositions', 'tags', 'categories', 'video', 'audio');

        #$photoPath = $author->photo()->media()->path;

        $exhibit = $exhibit->toArray();

        unset($exhibit['photo']);

        $exhibit['photo_path'] = 'museum.lc/uploads/';

        return response()->json($exhibit);
    }
}