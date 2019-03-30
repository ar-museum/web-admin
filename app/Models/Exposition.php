<?php

namespace App\Models;

use App\BaseModel;

class Exposition extends BaseModel
{
    //
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'exposition_id';

    protected $fillable = ['title', 'description'];

    public function museum()
    {
        return $this->belongsTo(Museum::class);
    }
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
    public function exhibit()
    {
        return $this->hasMany(Exhibit::class);
    }
    public function media()
    {
        return $this->hasOne(Media::class);
    }
}
