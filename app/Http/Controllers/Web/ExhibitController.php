<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exhibit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExhibitController extends Controller
{
    public function index()
    {
        return view('dashboard.exhibit', [
            'exhibits' => Exhibit::lastFive()->get(),
            'exhibits_no' => Exhibit::all()->count(),
        ]);
    }

    public function create()
    {
        return view('dashboard.exhibit.blade.php');
    }

    public function store(Request $request)
    {
        $exhibit = new Exhibit();
        $exhibit->title = $request->get('title');
        $exhibit->short_description = $request->get('s_description');
        $exhibit->description = $request->get('description');
        $exhibit->start_year = $request->get('start_year');
        $exhibit->end_year = $request->get('end_year');
        $exhibit->size = $request->get('size');
        $exhibit->location = $request->get('location');
        $exhibit->author_id = $request->get('author_id');
        $exhibit->exposition_id = $request->get('exposition_id');
        $exhibit->staff_id = $request->get('staff_id');
        $exhibit->audio_id = $request->get('audio_id');
        $exhibit->photo_id = $request->get('photo_id');
        $exhibit->video_id = $request->get('video_id');
        $exhibit->save();
        return redirect('/exhibit')->with('success', 'Exponat adaugat');

    }

    public function edit($var)
    {
    }

    public function destroy($var)
    {

    }
}