<?php


namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exhibit;
use App\Models\Author;
use App\Models\Media;
use App\Models\Staff;
use App\Models\Exposition;
use App\Models\Audio;
use App\Models\Photo;
use App\Models\Video;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

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
            'author_id' => 'required',
            'exposition_id' => 'required',
            'staff_id' => 'required',
            'audio' => 'required',
            'photo' => 'required'
        ]);
        $exhibit = new Exhibit();
        $exhibit->title = $request->get('title');
        $exhibit->short_description = $request->get('short_description');
        $exhibit->description = $request->get('description');

        if($request->get('start_year') == '') $exhibit->start_year=null;
        else $exhibit->start_year = $request->get('start_year');

        if($request->get('end_year') == '') $exhibit->end_year=null;
        else $exhibit->end_year = $request->get('end_year');
        
        $exhibit->size = $request->get('size');
        $exhibit->location = $request->get('location');
        $exhibit->author_id = $request->get('author_id');
        $exhibit->exposition_id = $request->get('exposition_id');
        $exhibit->staff_id = $request->get('staff_id');

        $yt_link = $request->get('yt_link');

        /** upload audio */

        if (request()->hasFile('audio')) {
            $audio = $request->file('audio');
            $new_filename = md5(time() . $audio->getClientOriginalName()) . '.' . $audio->getClientOriginalExtension();

            try {
                $audio->move(public_path('uploads' . DIRECTORY_SEPARATOR . 'audio' .
                    DIRECTORY_SEPARATOR), $new_filename);
            } catch (FileException $e) {
                return redirect()->back()->withErrors(['audio' => '* ' . $e->getMessage()])->withInput();
            }
        }

        $media = new Media();
        $media->path = 'uploads\audio' . DIRECTORY_SEPARATOR . $new_filename;
        $media->save();

        $audio = new Audio();
        $audio->audio_id = $media->media_id;
        $audio->length = 0;
        $audio->save();

        $exhibit->audio_id = $audio->audio_id;

        /** upload photo */
        if (request()->hasFile('photo')) {
            $photo        = $request->file('photo');
            $new_filename = md5(time() . $photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();

            try {
                $photo->move(public_path('uploads' . DIRECTORY_SEPARATOR . 'photo' .
                    DIRECTORY_SEPARATOR), $new_filename);
            } catch (FileException $e) {
                return redirect()->back()->withErrors(['photo' => '* ' . $e->getMessage()])->withInput();
            }
        }

        $media = new Media();
        $media->path = 'uploads' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR . $new_filename;

        $full_path = public_path() . DIRECTORY_SEPARATOR . $media->path ;
        $media->save();

        $photo = new Photo();
        $photo->photo_id = $media->media_id;

        $info_image = getimagesize($full_path);
        $photo->width = $info_image[0];
        $photo->height = $info_image[1];

        $photo->save();

        $exhibit->photo_id = $photo->photo_id;

        /** upload video */
        $media = new Media();
        $media->path = $yt_link;
        $media->save();

        $video = new Video();
        $video->video_id = $media->media_id;
        $video->length = 0;

        $video->save();

        $exhibit->video_id = $video->video_id;

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