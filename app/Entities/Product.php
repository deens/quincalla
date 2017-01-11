<?php

namespace Quincalla\Entities;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model implements Buyable
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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['abs_price'];

    protected $presenter = 'Quincalla\Http\Presenters\ProductPresenter';

    protected $searchable = [
        'columns' => [
            'name'        => 10,
            'description' => 5,
        ],
    ];

    protected $rulesColumns = [
        'name'            => 'Name',
        'type'            => 'Type',
        'vendor'          => 'Vendor',
        'price'           => 'Price',
        'tag'             => 'Tag',
        'compare_price'   => 'Compare price at',
        'weight'          => 'Weight',
        'inventory_stock' => 'Inventory Stock',
    ];

    protected $rulesSortOptions = [
        'name' => [
            'asc'  => 'Alphabetical: A-Z',
            'desc' => 'Alphabetical: Z-A',
        ],
        'price' => [
            'asc'  => 'Price: Lowest to highest',
            'desc' => 'Price: Highest to lowest',
        ],
        'created_at' => [
            'asc'  => 'By date: Oldest to newest',
            'desc' => 'By date: Newest to oldest',
        ],
    ];

    /**
     * Get all the collections that belongs to a product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function collections()
    {
        return $this->belongsToMany('Quincalla\Entities\Collection');
    }

    /**
     * Get all the tags that belongs to a product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
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

    /**
     * Get the absolute price of product.
     *
     * @return float
     */
    public function getAbsPriceAttribute()
    {
        return ( ! is_null($this->compare_price) && (int) $this->compare_price < (int) $this->price)
            ? $this->compare_price / 100
            : $this->price / 100;
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->getAbsPriceAttribute();
    }
}
