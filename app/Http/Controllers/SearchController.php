<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Product;
use Quincalla\Http\Requests\SearchQueryRequest;


class SearchController extends Controller
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

    public function index(SearchQueryRequest $request)
    {
        $pageLimit = 6;

        $query = $request->get('query');
        $results = $this->products->search($query)
            ->paginate($pageLimit);

        return view('search', compact('query', 'results'));
    }
}
