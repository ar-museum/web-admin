<?php

namespace App\Models;

use App\BaseModel;

class Tag extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'tag_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function exhibit(){
        return $this->hasMany(Exhibit::class);
    }
}
