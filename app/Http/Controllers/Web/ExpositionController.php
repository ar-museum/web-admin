<?php

namespace App\Http\Controllers\Web;

use App\Models\Exposition;
use App\Models\Museum;
use App\Models\Photo;
use App\Models\Staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpositionController extends Controller
{
    //
    public function index()
    {
        return view('exposition.index', [
            'expositions' => Exposition::with('exhibits','museum')->get(),
            'expositions_no' => Exposition::all()->count(),
            'museums' => Museum::all(),
            'photos' => Photo::all(),
            'staffs' => Staff::all(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
        ]);
        $exposition = new Exposition();
        $exposition->title = $request->get('title');
        $exposition->description = $request->get('description');
        $exposition->museum_id =$request->get('museum-id');
        $exposition->staff_id=$request->get('staff-id');
        $exposition->photo_id=$request->get('photo-id');

        $exposition->save();
        return redirect('/exposition')->with('success','Expozitie adaugata');
    }
    public function delete($exposition_id)
    {
        try {
            $exposition = Student::findOrFail($exposition_id);
            $exposition->delete();
        } catch (\Exception $e) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('exposition');
            }

            return error($e->getMessage());
        }


        if (request()->getMethod() == 'GET') {
            return redirect()->route('exposition', ['id' => $exposition_id]);
        }

        return response()->json(['message' => 'Expozitia ' . $exposition->title . ' a fost stearsa cu succes!']);
    }

}
