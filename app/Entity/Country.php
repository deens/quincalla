<?php namespace Quincalla\Entity;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    protected $table = 'countries';

    public function states()
    {
        return $this->hasMany('Quincalla\State');
    }

}
