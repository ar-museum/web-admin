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

    public function getPathAttribute()
    {
        $path = Media::where('media_id', $this->photo_id)->select('path')->get();
        if(count($path) > 0)
        {
            return $path[0]->path;
        }
        return ' ';
    }
}
