<?php namespace Quincalla\Http\Controllers;

use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller {

	public function index()
	{
        $query = \Request::get('query');
        $results = Product::search($query)->get();

        return view('search', compact('query', 'results'));
	}

}
