<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Product;
use Quincalla\Entities\Collection;

class CollectionsController extends Controller
{
    public function show($slug, Product $products)
    {
        $pageLimit = 6;

        $collection = Collection::published()
            ->whereSlug($slug)
            ->firstOrFail();

        if ($collection->type === 'condition') {
            $products = $products->paginateByRules(
                    $collection->match,
                    $collection->rules,
                    $collection->sort_order,
                    $pageLimit
                );
        } else {
            $products = $collection->products()
                ->published()
                ->simplePaginate($pageLimit);
        }

        return view('collection', compact( 'collection', 'products'));
    }
}
