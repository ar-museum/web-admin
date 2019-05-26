<?php

namespace App\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\Builder;

class ExhibitTag extends BaseModel
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = array('exhibit_id', 'tag_id');

    protected $table = 'exhibit_tags';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'exhibit_id', 'tag_id',
        ];

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     *
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('exhibit_id', '=', $this->getAttribute('exhibit_id'))
            ->where('tag_id', '=', $this->getAttribute('tag_id'));

        return $query;
    }
     */

    /**
     * Used for primary composed key.
     *
     * @return string
     */
    public function getKeyName()
    {
        return 'tag_id';
    }

    public function exhibit()
    {
        return $this->belongsToMany(Exhibit::class, 'exhibit_id', 'exhibit_id');
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'tag_id', 'tag_id');
    }
}