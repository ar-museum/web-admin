<?php

namespace App\Models;

use App\BaseModel;

class Photo extends BaseModel
{
    protected $fillable = ['width','height'];

    protected $hidden = [];

    /* Relationship methods */
    public function media(){
        return $this->hasOne(Media::class);
    }
}
