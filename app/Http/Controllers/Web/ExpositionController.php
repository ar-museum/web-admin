<?php

namespace App\Http\Controllers\Web;

use App\Models\Exposition;
use App\Models\Museum;
use App\Models\Photo;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class ExpositionController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.show', [
            'expositions' => Exposition::with('museum')->lastFive()->get(),
            'expositions_no' => Exposition::all()->count(),
            'museums' => Museum::all(),
            'photos' => Photo::all(),
            'staffs' => Staff::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.show');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title-expo' => 'required',
            'description-expo' => 'required',
        ]);
        $exposition = new Exposition();
        $exposition->title = $request->get('title-expo');
        $exposition->description = $request->get('description-expo');
        $exposition->museum_id =$request->get('museum-expo');
        $exposition->staff_id=$request->get('staff-expo');
        $exposition->photo_id=$request->get('photo-expo');


        $exposition->save();
        return redirect('/exposition')->with('success','Expozitie adaugata');
    }


}
