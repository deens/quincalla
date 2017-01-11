<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function states()
    {
        return $this->hasMany('Quincalla\Entities\State');
    }
}
