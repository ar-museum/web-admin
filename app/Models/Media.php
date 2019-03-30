<?php

namespace App\Models;

use App\BaseModel;

class Media extends BaseModel
{
    protected $fillable = ['path'];

    protected $hidden = [];

    /* Relationship methods */
    public function exhibit(){
        return $this->hasOne(Exhibit::class);
    }
}
