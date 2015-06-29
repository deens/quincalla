<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collections';
    protected $fillable = [];

    public function products()
    {
        return $this->hasMany('Quincalla\Entities\Product');
    }
}
