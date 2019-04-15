<?php

namespace App\Models;

use App\BaseModel;

class Museum extends BaseModel
{
    protected $table = 'museum';

    protected $primaryKey = 'museum_id';

    protected $fillable = [
        'museum_id','name', 'address', 'opening_hour', 'closing_hour'
    ];

    public function expositions ()
    {
        return $this->hasMany(Exposition::class, 'museum_id', 'museum_id');
    }
}
