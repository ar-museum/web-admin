<?php


namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Exhibit;
use App\Models\Author;

class ExhibitController extends Controller
{
    public function index(){
        return view('dashboard.exhibit', [
            'exhibits' => Exhibit::lastFive()->get(),
            'exhibits_no' => Exhibit::all()->count(),
        ]);
    }

    public function store($var){

    }

    public function edit($var){
    }

    public function destroy($var){

    }
}