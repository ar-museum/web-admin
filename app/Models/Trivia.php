<?php


namespace App\Models;
use App\BaseModel;
use Illuminate\Notifications\Notifiable;

class Trivia extends BaseModel
{
    /**
 * The primary key for the model.
 *
 * @var string
 */
    use Notifiable;

    protected $primaryKey ='trivia_id';
    protected $table='trivia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable=['json_name', 'museum_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ ];

    /** Relationship methods */
    public function museum(){
        return $this->belongsTo(Museum::class,'museum_id', 'museum_id');
    }
}