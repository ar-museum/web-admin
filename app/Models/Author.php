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
       'full_name', 'born_year', 'died_year',  'location',   'photo_id'
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
        return $this->belongsTo(Staff::class);
    }

    public function exhibit(){
        return $this->hasMany( Exhibit::class);
    }
}