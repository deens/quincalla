<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collections';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'type', 
        'condition',
        'sort_order',
        'rules',
        'published'
    ];

    public function products()
    {
        return $this->belongsToMany('Quincalla\Entities\Product');
    }
}
