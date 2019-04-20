<?php


namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Support\Facades\Input;
use App\Mosels\Museum;

class MuseumController  extends Controller
{

    public function index()
    {

    }

    public function store($var)
    {
        $museum=factory(\App\Models\Museum::class, 1)->create();
        $museum->name= Input::get('museum_name');
        $museum->address= Input::get('museum_address');
        $museum->save();
    }

}