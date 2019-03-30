<?php

namespace App\Models;

use App\BaseModel;

class Exhibit extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'short_description', 'description', 'start_year', 'end_year', 'size', 'location',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'author_id'
    ];

    /** Relationship methods */
    public function staff(){
        return $this->hasOne(Staff::class);
    }

    public function author(){
        return $this->hasOne(Author::class);
    }

    public function exposition(){
        return $this->hasOne(Exposition::class);
    }

    public function guest(){
        return $this->belongsToMany(Guest::class);
    }
}
