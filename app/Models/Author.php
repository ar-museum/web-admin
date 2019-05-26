<?php


namespace App\Models;
use App\BaseModel;

class Author extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey ='author_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    protected $fillable = [
       'full_name', 'description', 'born_year', 'died_year',  'location', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /** Relationship methods */
    public function staff(){
        return $this->belongsTo(Staff::class,'staff_id', 'staff_id');
    }


    public function exhibits(){
        return $this->hasMany( Exhibit::class, 'exhibit_id', 'exhibit_id');
    }

    public function photo()
    {
        return $this->hasManyThrough(Photo::class, Media::class,'media_id', 'photo_id', 'photo_id');
    }
    /**
     * Scope a query to find last 5 expositions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query_obj
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastFive($query_obj)
    {
        return $query_obj->orderBy('author_id', 'desc')
                         ->take(5);
    }

    /** Function to get photo path by photo_id */
    public function getPhotoPath()
    {
        return $this->photo[0]->path;
    }
}