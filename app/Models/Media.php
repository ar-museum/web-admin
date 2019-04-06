<?php

namespace App\Models;

use App\BaseModel;

class Media extends BaseModel
{
    protected $fillable = ['path'];

    protected $hidden = [];

    //@TODO: Fix the relationship.
    public function exhibit(){
        return $this->hasOne(Exhibit::class);
    }

    //@TODO: Fix the relationship.
    public function exposition(){
        return $this->hasOne(Exposition::class);
    }
}
