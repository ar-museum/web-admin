<?php

namespace App\Models;

use App\BaseModel;

class Exposition extends BaseModel
{
    //
    protected $fillable = [ 'title', 'description'];

    public function museum()
    {
        return $this->hasOne('App\Model\Museum');
    }
    public function staff()
    {
        return $this->hasOne('App\Model\Staff');
    }

}
