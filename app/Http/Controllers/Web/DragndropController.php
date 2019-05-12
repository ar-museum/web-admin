<?php

namespace App\Http\Controllers\Web;

use App\Models\Museum;

use App\Http\Controllers\Controller;
use App\Models\Dragndrop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class DragndropController extends Controller
{
    //
    public function index()
    {
        return view('dragndrop.index', [
            'dragndrops' => Dragndrop::all(),
            'museums' => Museum::all(),
            'museums_no' => Museum::all()->count()
        ]);
    }

    public function create()
    {
        return view('dragndrop.index');
    }

    public function destroy($var){
        try {
            $trivia = Dragndrop::findOrFail($var);
            $trivia->delete();
        } catch (\Exception $e) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('dragndrop');
            }

            return error($e->getMessage());
        }

        if (request()->getMethod() == 'GET') {
            return redirect()->route('delete-dragndrop', ['dragndrop_id' => $var]);
        }

        return response()->json(['message' => 'Informatia  a fost stearsa cu succes!']);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'photo' => 'required',
            'museum-id' => 'required'
        ]);
        $museum = $request->get('museum-id');
        $name=DB::table('museum')->where('museum_id', $museum)->pluck('name')->first();

        $name_museum_folder = preg_replace('/\s+/', '', $name);


        if (request()->hasFile('photo')) {
            $photo        = $request->file('photo');
            $new_filename = $photo->getClientOriginalName();

            try {
                $photo->move(public_path('uploads' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR .'dragndrop'.DIRECTORY_SEPARATOR. $name_museum_folder .
                    DIRECTORY_SEPARATOR), $new_filename);
            } catch (FileException $e) {
                return redirect()->back()->withErrors(['photo' => '* ' . $e->getMessage()])->withInput();
            }
        }

        $media = new Dragndrop();
        $media->path = 'uploads' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR .'dragndrop'.DIRECTORY_SEPARATOR. $name_museum_folder . DIRECTORY_SEPARATOR . $new_filename;

        $media->museum_id=$museum;
        $media->save();

        return redirect('/dragndrop')->with('success','Fotografie adaugata la muzeul '.$name);
    }
}
