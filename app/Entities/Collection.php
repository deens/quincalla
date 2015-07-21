<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    /**
     * @var string Entity table name
     */
    protected $table = 'collections';

    /**
     * @var array Definition of mass assignable fields
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'type',
        'match',
        'sort_order',
        'rules',
        'published',
    ];

    /**
     * Get all the products that belongs to a collection.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function products()
    {
        return $this->belongsToMany('Quincalla\Entities\Product');
    }

    /**
     * Get collection rules.
     *
     * @param array $value
     *
     * @return object
     */
    public function getRulesAttribute($value)
    {
        return json_decode($value);
    }

    /**
     * Set collection rules.
     *
     * @param array $value
     *
     * @return void
     */
    public function setRulesAttribute($value)
    {
        $this->attributes['rules'] = json_encode($value);
    }

    /**
     * Set Published Scope.
     *
     * @param $query Illuminate\Database\Eloquent\Builder
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    /**
     * Retrive an array of collections name and ids
     *
     * @return array
     */
    public function getArrayListManualPublished()
    {
        return $this->published()
            ->where('type', 'manual')
            ->lists('name', 'id')
            ->toArray();
    }
}
