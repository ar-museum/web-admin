<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'first_name',
            'last_name',
            'email',
            'password',
            'photo_id',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password', 'remember_token',
        ];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'staff_id';

    /**
     * Get complete name of staff.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get the expositions added by staff.
     */
    public function expositions()
    {
        return $this->hasMany(Exposition::class, 'staff_id');
    }

    /**
     * Get the exhibits added by staff.
     */
    public function exhibits()
    {
        return $this->hasMany(Exhibit::class, 'staff_id');
    }

    /**
     * Get the categories added by staff.
     */
    public function categories()
    {
        return $this->hasMany(Category::class, 'staff_id');
    }

    /**
     * Get the tags added by staff.
     */
    public function tags()
    {
        return $this->hasMany(Tag::class, 'staff_id');
    }

    /**
     * Get the authors added by staff.
     */
    public function authors()
    {
        return $this->hasMany(Author::class, 'staff_id');
    }
}
