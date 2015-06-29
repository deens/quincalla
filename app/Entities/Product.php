<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laracasts\Presenter\PresentableTrait;

class Product extends Model
{
    use SearchableTrait;
    use PresentableTrait;

    protected $table = 'products';
    protected $fillable = [];
    protected $presenter = 'Quincalla\Http\Presenters\ProductPresenter';
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'description' => 5,
        ]
    ];

    public function collection()
    {
        return $this->belongsTo('Quincalla\Entities\Collection');
    }

    public function tags()
    {
        return $this->belongsToMany('Quincalla\Entities\Tag');
    }
}
