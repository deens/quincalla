<?php namespace Quincalla;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model {

    use SearchableTrait;

    protected $table = 'products';
    protected $fillable = [];
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'description' => 5,
        ]
    ];

    public function collection()
    {
        return $this->belongsTo('Quincalla\Collection');
    }
}
