<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $category = Category::with('exhibit')->get()->toArray();

        return response()->json($category);
    }

    public function getData($var){
        $category = Category::with('exhibit')->get()->find($var);

        #$photoPath = $author->photo()->media()->path;

        $category = $category->toArray();

        return response()->json($category);
    }
}