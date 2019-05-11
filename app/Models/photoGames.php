<?php

namespace App\Models;

use App\BaseModel;

class photoGames extends BaseModel
{
    protected $table = 'photoGames';

    protected $primaryKey = 'photo_id';

    protected $fillable = ['photo_id','width','height','title'];

    protected $hidden = [];

    /* Relationship methods */
    public function media(){
        return $this->belongsTo(Media::class);
    }

    public function getPathAttribute()
    {
        $path = Media::where('media_id', $this->photo_id)->select('path')->get();
        if(count($path) > 0)
        {
            return $path[0]->path;
        }
        return '-';
    }

    public function getTitleAttribute()
    {
        //$title = photoGames::select(['title'])->where('photo_id', $this->photo_id)->first()->toArray();
        $title = photoGames::select('title')->find($this->photo_id)->first();
        //$title = photoGames::where('photo_id', $this->photo_id)->select('title')->first()->toArray();
        if(count($title) > 0)
        {
            return $title[0];
        }
        return '-';
    }

    public function getWidthAttribute()
    {
        $width_var = photoGames::where('photo_id', $this->photo_id)->select('width')->get();
        if(count($width_var) > 0)
        {
            return $width_var[0]->width;
        }
        return '-';
    }

    public function getHeightAttribute()
    {
        $height = photoGames::where('photo_id', $this->photo_id)->select('height')->get();
        if(count($height) > 0)
        {
            return $height[0]->height;
        }
        return '-';
    }
}
