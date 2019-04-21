<?php

namespace App\Models;

use App\BaseModel;
use Faker\Generator;

class Photo extends BaseModel
{
    protected $table = 'photo';

    protected $fillable = ['photo_id','width','height'];

    protected $hidden = [];

    /* Relationship methods */
    public function media(){
        return $this->belongsTo(Media::class);
    }

    public function exhibit(){
        return $this->belongsTo(Exhibit::class, 'photo_id', 'photo_id');
    }

    public function addPhotoToDB($path_photo, $width_photo, $height_photo)
    {
        $id = DB::table('media')->insertGetId([
            'path' => $path_photo
        ]);

        DB::table('photo')->insert([
            'photo_id' => $id,
            'width' => $width_photo,
            'height' => $height_photo,
        ]);
    }
}
