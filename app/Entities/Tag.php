<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany('Quincalla\Entities\Product')
            ->withTimestamps();
    }
}
