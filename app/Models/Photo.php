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
}
