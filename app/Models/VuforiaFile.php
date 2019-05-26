<?php

namespace App\Models;

use App\BaseModel;
use Illuminate\Notifications\Notifiable;

class VuforiaFile extends BaseModel
{
    use Notifiable;

    // Members

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vuforia_files';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'file_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    // Relationship methods

    public function vuforia()
    {
        return $this->hasMany(Vuforia::class,'file_id','file_id');
    }

    public function scopeLastFive()
    {
        return VuforiaFile::orderBy('file_id', 'desc')->take(5);
    }
}