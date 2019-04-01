<?php

namespace App\Models;

use App\BaseModel;

class Museum extends BaseModel
{
    protected $primaryKey = 'name';
    protected $fillable = [
        'name', 'address', 'opening_hour', 'closing_hour'
    ];
    // @TODO: Add missing id column
    
    public function exposition()
    {
        return $this->hasMany(Exposition::class);
    }
}
