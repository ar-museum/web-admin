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

    public function exhibit()
    {
        return $this->hasManyThrough(ExhibitTag::class,Tag::class , 'tag_id', 'exhibit_id', 'tag_id');
    }

    /**
     * Scope a query to find last 5 expositions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query_obj
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastFive($query_obj)
    {
        return $query_obj->orderBy('tag_id', 'desc')
                         ->take(5);
    }
}
