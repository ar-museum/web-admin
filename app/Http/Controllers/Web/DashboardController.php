<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Exhibit;
use App\Models\Exposition;
use App\Models\Media;

class DashboardController extends Controller
{
    public function index()
    {
        #$dd = $this->staff->can("delete", []);
        return view('dashboard.index', [
            'expositions_no' => Exposition::all()->count(),
            'exhibits_no' => Exhibit::all()->count(),
            'authors_no' => Author::all()->count(),
            'last_expositions' => Exposition::lastFive()->get(),
            #'media_no' => Media::all()->count(),
        ]);
    }
}