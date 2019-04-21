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
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        #$dd = $this->staff->can("delete", []);
        #$exhibits = Exhibit::with('tag')->get();
        #$tags = Tag::with('exhibit')->get();

        $museum=new Museum();

        $name=DB::table('museum')->pluck('name');
        $newName=substr($name,2,strlen($name)-4);
        $address=DB::table('museum')->pluck('address');
        $newAddress=substr($address,2,strlen($address)-4);
        $museum->setMuseumName($newName);
        $museum->setMuseumAddress($newAddress);
        $museum->setMondayProgram(substr(DB::table('museum')->pluck('monday_opening_hour'),2,8), substr(DB::table('museum')->pluck('monday_closing_hour'),2,8));
        $museum->setTuesdayProgram(substr(DB::table('museum')->pluck('tuesday_opening_hour'),2,8), substr(DB::table('museum')->pluck('tuesday_closing_hour'),2,8));
        $museum->setWednesdayProgram(substr(DB::table('museum')->pluck('wednesday_opening_hour'),2,8), substr(DB::table('museum')->pluck('wednesday_closing_hour'),2,8));
        $museum->setThursdayProgram(substr(DB::table('museum')->pluck('thursday_opening_hour'),2,8), substr(DB::table('museum')->pluck('thursday_closing_hour'),2,8));
        $museum->setFridayProgram(substr(DB::table('museum')->pluck('friday_opening_hour'),2,8), substr(DB::table('museum')->pluck('friday_closing_hour'),2,8));
        $museum->setSaturdayProgram(substr(DB::table('museum')->pluck('tuesday_opening_hour'),2,8), substr(DB::table('museum')->pluck('saturday_closing_hour'),2,8));
        $museum->setSundayProgram(substr(DB::table('museum')->pluck('sunday_opening_hour'),2,8), substr(DB::table('museum')->pluck('sunday_closing_hour'),2,8));






        return view('dashboard.index', [
            'expositions_no' => Exposition::all()->count(),
            'exhibits_no' => Exhibit::all()->count(),
            'authors_no' => Author::all()->count(),
            'media_no' => Media::all()->count(),
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