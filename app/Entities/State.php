<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo('Quincalla\Entities\Country');
    }
}
