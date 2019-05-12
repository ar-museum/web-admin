<?php

namespace App\Models;

use App\BaseModel;

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

    public function getWidthAttribute()
    {
        $width_var = Photo::where('photo_id', $this->photo_id)->select('width')->get();
        if(count($width_var) > 0)
        {
            return $width_var[0]->width;
        }
        return '-';
    }

    public function getHeightAttribute()
    {
        $height = Photo::where('photo_id', $this->photo_id)->select('height')->get();
        if(count($height) > 0)
        {
            return $height[0]->height;
        }
        return '-';
    }
}
