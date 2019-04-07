<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Exhibit;
use App\Models\Exposition;
use App\Models\Media;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function index()
    {
        #$dd = $this->staff->can("delete", []);
        #$exhibits = Exhibit::with('tag')->get();
        #$tags = Tag::with('exhibit')->get();

        return view('dashboard.index', [
            'expositions_no' => Exposition::all()->count(),
            'exhibits_no' => Exhibit::all()->count(),
            'authors_no' => Author::all()->count(),
            'expositions' => Exposition::with('museum')->lastFive()->get(),
            'exhibits' => Exhibit::lastFive()->get(),
            'authors' => Author::lastFive()->get(),
            'media' => Media::lastFive()->get(),
            'categories' => Category::lastFive()->get(),
            'tags' => Tag::lastFive()->get(),
            #'media_no' => Media::all()->count(),
        ]);
    }
}