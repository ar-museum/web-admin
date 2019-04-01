<?php

namespace App\Models;

use App\BaseModel;

class Audio extends BaseModel
{
    protected $fillable = ['length'];

    protected $hidden = [];

    //@TODO: Fix the relationship.
    public function media(){
        return $this->hasOne(Media::class);
    }
}
