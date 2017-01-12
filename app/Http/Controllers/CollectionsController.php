<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Collection;
use Quincalla\Entities\Product;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CollectionsController extends Controller
{
    protected $collections;

    public function __construct(Collection $collections)
    {
        $this->collections = $collections;
    }

    public function show($slug, Product $products)
    {
        $pageLimit = 6;

        $collection = $this->collections->published()
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

        return view('collection', compact(
            'collection',
            'products'
        ));
    }
}
