<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{

    public function index()
    {
        try {
            $category = Category::all()->toArray();
        }  catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista categorii in baza de date.'
            ), 404);
        }

        return response()->json($category);
    }

    public function indexWithRelationships(){
        try {
            $category = Category::with('exhibit')->get();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista categorii in baza de date.'
            ), 404);
        }

        return response()->json($category);
    }

    public function getData($var){
        #$category = Category::with('exhibit')->get()->find($var);

        try {
            $category = Category::findOrFail($var);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista aceasta categorie in baza de date.'
            ), 404);
        }

        #$photoPath = $author->photo()->media()->path;

        $category = $category->toArray();

        return response()->json($category);
    }

    public function getDataWithRelationships($var){
        try {
            $category = Category::findOrFail($var);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista aceasta categorie in baza de date.'
            ), 404);
        }

        $category->load('exhibit');

        $category = $category->toArray();

        return response()->json($category);
    }
}