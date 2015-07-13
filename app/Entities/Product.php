<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laracasts\Presenter\PresentableTrait;
use Quincalla\Entities\SmartRulesTrait;

class Product extends Model
{
    use SearchableTrait;
    use PresentableTrait;
    use SmartRulesTrait;

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
    protected $rulesColumns = [
        'name'              => 'Name',
        'type'              => 'Type',
        'vendor'            => 'Vendor',
        'price'             => 'Price',
        'tag'               => 'Tag',
        'price'             => 'Compare price at',
        'weitgh'            => 'Weitgh',
        'inventory_stock'   => 'Inventory Stock',
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

    public function getConditionalProducts($collection)
    {
        return false;
    }
}
