<?php

namespace App\Models;

use App\BaseModel;

class Media extends BaseModel
{
    protected $table = 'media';

    protected $primaryKey = 'media_id';

    protected $fillable = ['path'];

    protected $hidden = [];

    public function exhibit(){
        return $this->belongsToMany(Exhibit::class);
    }

    public function exposition(){
        return $this->belongsToMany(Exposition::class);
    }

    public function photo(){
        return $this->hasMany(Photo::class);
    }

    public function audio(){
        return $this->hasMany(Audio::class);
    }

    public function video(){
        return $this->hasMany(Video::class);
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
