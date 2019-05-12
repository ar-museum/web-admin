<?php


namespace App\Models;

use Illuminate\Notifications\Notifiable;
use App\BaseModel;
class Dragndrop extends BaseModel
{
    use Notifiable;
    // Members
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dragndrop';
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'dragndrop_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'museum_id', 'path'
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
}
