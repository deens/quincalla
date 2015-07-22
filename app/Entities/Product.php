<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Laracasts\Presenter\PresentableTrait;

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
        ],
    ];
    protected $rulesColumns = [
        'name' => 'Name',
        'type' => 'Type',
        'vendor' => 'Vendor',
        'price' => 'Price',
        'tag' => 'Tag',
        'price' => 'Compare price at',
        'weitgh' => 'Weitgh',
        'inventory_stock' => 'Inventory Stock',
    ];
    protected $rulesSortOptions = [
        'name' => [
            'asc' => 'Alphabetical: A-Z',
            'desc' => 'Alphabetical: Z-A',
        ],
        'price' => [
            'asc' => 'Price: Lowest to highest',
            'desc' => 'Price: Highest to lowest',
        ],
        'created_at' => [
            'asc' => 'By date: Oldest to newest',
            'desc' => 'By date: Newest to oldest',
        ],
    ];

    /**
     * Get all the collections that belongs to a product
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function collections()
    {
        return $this->belongsToMany('Quincalla\Entities\Collection');
    }

    /**
     * Get all the tags that belongs to a product
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function tags()
    {
        return $this->belongsToMany('Quincalla\Entities\Tag');
    }

    /**
     * Define published scope.
     *
     * @param object $query
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }
}
