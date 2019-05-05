<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Museum;
use App\Models\Vuforia;

class VuforiaController extends Controller
{
    public function index()
    {
        return view('vuforia.index', [
            'medias' => Media::all(),
            'medias_no' => Media::all()->count(),
            'vuforias' => Vuforia::all(),
            'vuforias_no' => Vuforia::all()->count(),
            'museums' => Museum::all(),
            'museums_no' => Museum::all()->count()
        ]);
    }

    public function create()
    {
        return view('vuforia.index');
    }
}