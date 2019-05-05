<?php

namespace App\Http\Controllers\Web;

use App\Models\Exposition;
use App\Models\Media;
use App\Models\Museum;
use App\Models\Photo;
use App\Models\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ExpositionController extends Controller
{
    //
    public function index()
    {
        return view('exposition.index', [
            'expositions' => Exposition::with('exhibits', 'museum')->get(),
            'expositions_no' => Exposition::all()->count(),
            'museums' => Museum::all(),
            'photos' => Photo::all(),
        ]);

    }

    public function edit($id)
    {
        return view('exposition.edit', [
            'exposition' => Exposition::where('exposition_id',  '=', $id)->first(),
            'museums' => Museum::all(),
            'photos' => Photo::all(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required',
        ]);
        $exposition = new Exposition();
        $exposition->title = $request->get('title');
        $exposition->description = $request->get('description');
        $exposition->museum_id = $request->get('museum-id');
        $exposition->staff_id = $this->staff->staff_id;

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

        $exposition->photo_id = $media->media_id;
        $exposition->save();
        return redirect('/exposition')->with('success', 'Expozitie adaugata');
    }

    public function destroy($var)
    {
        try {
            $exposition = Exposition::findOrFail($var);
            $exposition->delete();
        } catch (\Exception $e) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('exposition');
            }

            return error($e->getMessage());
        }


        if (request()->getMethod() == 'GET') {
            return redirect()->route('delete-exposition', ['exposition_id' => $var]);
        }

        return response()->json(['message' => 'Expozitia  ' . $exposition->title . ' a fost sters cu succes!']);
    }

    public function update(Request $request,$id)
    {
        $exposition = Exposition::where('exposition_id', '=', $id)->first();
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'museum_id' => 'required',
            'photo_id' => 'required',
        ]);
        $exposition->update($request->all());
        return redirect('/exposition')->with('success', 'Expozitie modificata');
    }


}
