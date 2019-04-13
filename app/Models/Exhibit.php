<?php

namespace App\Models;

use App\BaseModel;

class Exhibit extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'exhibit_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'title', 'short_description', 'description', 'start_year', 'end_year', 'size', 'location',
            'exposition_id', 'author_id', 'photo_id', 'audio_id', 'video_id'
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'author_id', 'photo_id', 'audio_id', 'video_id',
        ];

    /** Relationship methods */
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id', 'staff_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'author_id');
    }

    public function exposition()
    {
        return $this->belongsTo(Exposition::class, 'exposition_id', 'exposition_id');
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function tag()
    {
        return $this->hasManyThrough(Tag::class, ExhibitTag::class, 'exhibit_id', 'tag_id', 'exhibit_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function category()
    {
        return $this->hasManyThrough(Category::class, ExhibitCategory::class, 'exhibit_id', 'category_id', 'exhibit_id');
    }

    public function photo()
    {
        return $this->hasManyThrough(Photo::class, Media::class, 'media_id', 'photo_id', 'photo_id');
    }

    public function video()
    {
        return $this->hasManyThrough(Video::class, Media::class,'media_id', 'video_id', 'video_id');
    }

    public function audio()
    {
        return $this->hasManyThrough(Audio::class, Media::class,'media_id', 'audio_id', 'audio_id');
    }

    /**
     * Scope a query to find last 5 expositions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query_obj
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastFive($query_obj)
    {
        return $query_obj->orderBy('exhibit_id', 'desc')
                         ->take(5);
    }
}
