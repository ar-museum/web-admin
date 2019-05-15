<?php

namespace App\Models;

use App\BaseModel;

class Video extends BaseModel
{
    protected $table = 'video';

    protected $fillable = ['video_id','length'];

    protected $hidden = [];

    /* Relationship methods */
    public function media(){
        return $this->belongsTo(Media::class, 'video_id','media_id');
    }

    public function exhibit(){
        return $this->belongsTo(Exhibit::class, 'video_id', 'exhibit_id');
    }

    public function getPathAttribute()
    {
        return $this->media->path;
    }
}
