<?php namespace Quincalla;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model {

    protected $table = 'collections';
    protected $fillable = [];

    public function products()
    {
        return $this->hasMany('Quincalla\Product');
    }
}
