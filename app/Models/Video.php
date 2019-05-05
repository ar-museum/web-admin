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
        return $this->belongsTo(Media::class);
    }

    public function exhibit(){
        return $this->belongsTo(Exhibit::class, 'video_id', 'video_id');
    }

    public function getPathAttribute($mediaId)
    {
        $path = Media::where('media_id', $mediaId)->select('path')->get();
        if(count($path) > 0)
        {
            return $path[0]->path;
        }
        return ' ';
    }
}
