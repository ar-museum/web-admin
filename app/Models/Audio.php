<?php

namespace App\Models;

use App\BaseModel;

class Audio extends BaseModel
{
    protected $table = 'audio';

    protected $fillable = ['audio_id','length'];

    protected $hidden = [];

    /* Relationship methods */
    public function media(){
        return $this->belongsTo(Media::class, 'audio_id','media_id');
    }

    public function exhibit(){
        return $this->belongsTo(Exhibit::class, 'audio_id', 'exhibit_id');
    }

    public function getPathAttribute()
    {
        return $this->media->path;
    }
}
