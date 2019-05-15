<?php

namespace App\Models;

use App\BaseModel;

class Photo extends BaseModel
{
    protected $table = 'photo';

    protected $primaryKey = 'photo_id';

    protected $fillable = ['photo_id','width','height'];

    protected $hidden = [];

    /* Relationship methods */
    public function media(){
        return $this->belongsTo(Media::class, 'photo_id','media_id');
    }

    public function exhibit(){
        return $this->belongsTo(Exhibit::class);
    }

    public function getPathAttribute()
    {
        return $this->media->path;
    }

}
