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

    /**
     * Scope a query to find last 5 expositions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query_obj
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastFive($query_obj)
    {
        return $query_obj->orderBy('media_id', 'desc')
                         ->take(5);
    }
}
