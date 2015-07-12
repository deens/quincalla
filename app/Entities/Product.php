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
    protected $fillable = [
        'collection_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'vendor',
        'type',
    ];
    protected $presenter = 'Quincalla\Http\Presenters\ProductPresenter';
    protected $searchable = [
        'columns' => [
            'name' => 10,
            'description' => 5,
        ]
    ];

    public function collection()
    {
        return $this->belongsToMany('Quincalla\Entities\Collection')
            ->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany('Quincalla\Entities\Tag');
    }
}
