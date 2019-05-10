<?php


namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Exposition;
use App\Models\Museum;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MuseumController  extends Controller
{

    public function index()
    {
        return view('museum.index', [
            'museums' => Museum::with('expositions')->get(),
        ]);
    }

    public function edit($id)
    {
        return view('museum.edit', []);
    }

    public function update(\Illuminate\Http\Request $request)
    {

        $name=DB::table('museum')->pluck('name');
        $newName=$request->get('museum_name');
        if($newName==null) {$newName=substr($name,2,strlen($name)-4);}
        DB::table('museum')->name->update($newName);
        return redirect('/museum')->with('success','Actualizare realizata');
    }

}