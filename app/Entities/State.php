<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model 
{
    protected $table = 'states';

    public function country()
    {
        return $this->belongsTo('Quincalla\Entities\Country');
    }
}
