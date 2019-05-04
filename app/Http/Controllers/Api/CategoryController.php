<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $category = Category::all()->toArray();

        return response()->json($category);
    }

    public function indexWithRelationships(){
        $category = Category::with('exhibit')->get();

        return response()->json($category);
    }

    public function getData($var){
        #$category = Category::with('exhibit')->get()->find($var);

        $category = Category::findOrFail($var);

        #$photoPath = $author->photo()->media()->path;

        $category = $category->toArray();

        return response()->json($category);
    }

    public function getDataWithRelationships($var){
        $category = Category::findOrFail($var);
        $category->load('exhibit');

        $category = $category->toArray();

        return response()->json($category);
    }
}