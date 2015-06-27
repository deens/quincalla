<?php

namespace Quincalla;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [];

    public function products()
    {
        return $this->belongsToMany('Quincalla\Product')->withTimestamps();
    }
}
