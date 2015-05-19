<?php namespace Quincalla;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = 'products';
    protected $fillable = [];

    public function collection()
    {
        return $this->belongsTo('Quincalla\Collection');
    }
}
