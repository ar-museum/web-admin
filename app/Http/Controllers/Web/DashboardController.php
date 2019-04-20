<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Category;
use App\Models\Exhibit;
use App\Models\Exposition;
use App\Models\Media;
use App\Models\Tag;
use App\Models\Museum;

class DashboardController extends Controller
{
    public function index()
    {
        #$dd = $this->staff->can("delete", []);
        #$exhibits = Exhibit::with('tag')->get();
        #$tags = Tag::with('exhibit')->get();

        $museum=factory(\App\Models\Museum::class, 1)->create();
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
            'museum_name'=>$museum->getMuseumName(),
            'museum_address'=>$museum->getMuseumAddress(),
            'monday_program' => $museum->getMondayProgram(),
            'tuesday_program' => $museum->getTuesdayProgram(),
            'wednesday_program' => $museum->getWednesdayProgram(),
            'thursday_program' => $museum->getThursdayProgram(),
            'friday_program' => $museum->getFridayProgram(),
            'saturday_program' => $museum->getSaturdayProgram(),
            'sunday_program' => $museum->getSundayProgram(),
            #'media_no' => Media::all()->count(),
        ]);
    }
}