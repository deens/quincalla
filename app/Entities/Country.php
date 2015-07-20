<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    public function states()
    {
        return $this->hasMany('Quincalla\Entities\State');
    }
}
