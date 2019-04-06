<?php

namespace App\Models;

use App\BaseModel;

class Category extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'category_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    //@TODO: Fix the relationship with exhibit.
    public function exhibit(){
        return $this->hasMany(Exhibit::class);
    }

    /**
     * Scope a query to find last 5 expositions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query_obj
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastFive($query_obj)
    {
        return $query_obj->orderBy('category_id', 'desc')
                         ->take(5);
    }
}