<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Product;
use Quincalla\Http\Requests\SearchQueryRequest;


class SearchController extends Controller
{
    public function index(SearchQueryRequest $request)
    {
        $pageLimit = 6;
        $query = $request->get('query');
        $results = Product::search($query)->paginate($pageLimit);

        return view('search', compact('query', 'results'));
    }
}
