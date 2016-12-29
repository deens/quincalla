<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Collection;
use Quincalla\Entities\Product;

class CollectionsController extends Controller
{
    protected $collections;

    public function __construct(Collection $collections)
    {
        $this->collections = $collections;
    }

    public function show($slug, Product $products)
    {
        $collection = $this->collections->whereSlug($slug)
            ->first();

        if ($collection->type === 'condition') {
            $products = $products->paginateByRules(
                $collection->match,
                $collection->rules,
                $collection->sort_order,
                6
                );
        } else {
            $products = $collection->products()
                ->simplePaginate(6);
        }

        return view('collection', compact(
            'collection',
            'products'
        ));
    }
}
