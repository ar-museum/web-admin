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

    protected $fillable = ['museum_id', 'title', 'description'];

    public function museum()
    {
        return $this->belongsTo(Museum::class, 'museum_id', 'exposition_id');
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

    /**
     * Scope a query to find last 5 expositions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query_obj
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastFive($query_obj)
    {
        return $query_obj->orderBy('exposition_id', 'desc')
                         ->take(5);
    }
}
