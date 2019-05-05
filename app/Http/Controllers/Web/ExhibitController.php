<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exhibit;
use App\Models\Author;
use App\Models\Staff;
use App\Models\Exposition;
use App\Models\Audio;
use App\Models\Photo;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ExhibitController extends Controller
{
    public function index()
    {
        $currentStaff = Staff::find($this->staff->staff_id)->withCount(['expositions', 'exhibits', 'categories', 'authors', 'tags'])->first();
        return view('exhibit.index', [
            'exhibits' => Exhibit::all(),
            'exhibits_no' => Exhibit::all()->count(),
            'authors' => Author::all(),
            'expositions' => Exposition::all(),
            'audios' => Audio::all(),
            'photos' => Photo::all(),
            'currentStaff' => $currentStaff,

        ]);
    }


    public function create()
    {
        return view('exhibit.index.blade.php');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
            'size' => 'required',
            'location' => 'required',
            'author_id' => 'required',
            'exposition_id' => 'required',
            'staff_id' => 'required',
            'audio_id' => 'required',
            'photo_id' => 'required',
            'video_id' => 'required',
        ]);
        $exhibit = new Exhibit();
        $exhibit->title = $request->get('title');
        $exhibit->short_description = $request->get('short_description');
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

    public function edit($id)
    {
        $currentStaff = Staff::find($this->staff->staff_id)->withCount(['expositions', 'exhibits', 'categories', 'authors', 'tags'])->first();
        return view('exhibit.edit', [
            'exhibit' => Exhibit::where('exhibit_id','=', $id)->first(),
            'authors' => Author::all(),
            'exhibits_no' => Exhibit::all()->count(),
            'expositions' => Exposition::all(),
            'audios' => Audio::all(),
            'photos' => Photo::all(),
            'video' =>Video::all(),
            'currentStaff' => $currentStaff,
        ]);
    }

    public function update(Request $request, $id){
        $exhibit=Exhibit::where('exhibit_id','=', $id)->first();
        $exhibit->update($request->all());
        return redirect('/exhibit')->with('success', 'Exponatul a fost modificat cu succes!');
    }

    public function destroy($var)
    {
        try {
            $exhibit = Exhibit::findOrFail($var);
            $exhibit->delete();
        } catch (\Exception $e) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('exhibit');
            }

            return error($e->getMessage());
        }

        if (request()->getMethod() == 'GET') {
            return redirect()->route('delete-exhibit', ['exhibit_id' => $var]);
        }

        return response()->json(['message' => 'Exponatul ' . $exhibit->title . ' a fost sters cu succes!']);
    }
}