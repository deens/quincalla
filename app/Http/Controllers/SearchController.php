<?php namespace Quincalla\Http\Controllers;

use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Requests\SearchQueryRequest;
use Quincalla\Http\Controllers\Controller;
use Quincalla\Request;

class SearchController extends Controller {

	public function index(SearchQueryRequest $request)
	{
        $query = \Request::get('query');
        $results = Product::search($query)->get();

        return view('search', compact('query', 'results'));
	}

}
