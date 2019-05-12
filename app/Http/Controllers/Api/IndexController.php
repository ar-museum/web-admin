<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Museum;
use App\Models\Vuforia;

class IndexController extends Controller
{

    public function index()
    {
        if(empty(request()->has("longitude")) || empty(request()->has("latitude"))){
            return response()->json(array(
                'message'      =>  "FORBIDDEN",
            ), 403);
        }
        $latitude = 27.57;
        $longitude = 47.18;
        $radius = 100;

        $museum = Museum::select(['name', 'latitude' , 'longitude'])
            ->selectRaw('( 6335 * acos( cos( radians(?) ) * cos( radians( latitude ) )
             * cos( radians( longitude ) - radians(?) ) + sin( radians(?) )
             * sin( radians( latitude ) ) ) ) AS distance', [$latitude, $longitude, $latitude])
            ->havingRaw("distance < ?", [$radius])
            ->orderBy("distance", "ASC")
            ->first()->toArray();

        $vuf = Vuforia::select(['version'])
                   ->join('museum', 'museum.museum_id', '=', 'vuforia.museum_id')
                   ->orderBy("version", "ASC")->first()->toArray();

        $museum['coordinates'] = $museum['longitude'].', '.$museum['latitude'];
        $museum['version'] = $vuf['version'];

        unset($vuf['version']);
        unset($museum['longitude']);
        unset($museum['latitude']);
        unset($museum['distance']);
        //dd($museum);

        return response()->json($museum);
    }
}