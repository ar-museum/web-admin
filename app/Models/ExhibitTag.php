<?php

namespace App\Models;

use App\BaseModel;

class ExhibitTag extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'exhibit_tag_id';

    protected $table = 'exhibit_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'exhibit_id', 'tag_id'
    ];


    public function exhibit()
    {
        return $this->belongsToMany(Exhibit::class, 'exhibit_id', 'exhibit_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'tag_id', 'tag_id');
    }
}