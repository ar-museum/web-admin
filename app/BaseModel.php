<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * The attributes that are excluded from saving/updating.
     *
     * @var array
     */
    protected $exclude = [];
}