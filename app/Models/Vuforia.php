<?php


namespace App\Models;

use App\BaseModel;
use Illuminate\Notifications\Notifiable;

class Vuforia extends BaseModel
{
    use Notifiable;

    // Members

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vuforia';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'vuforia_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'museum_id', 'file_id', 'version', 'file_type'
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

    public function museum()
    {
        return $this->belongsTo(Museum::class, 'museum_id', 'museum_id');
    }

    public function file()
    {
        return $this->belongsTo(VuforiaFile::class, 'file_id', 'file_id');
    }
}