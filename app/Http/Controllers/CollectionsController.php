<?php 
namespace Quincalla\Http\Controllers;

use Quincalla\Collection;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionsController extends Controller {

	public function show($slug)
	{
        $collections = Collection::all();
        $collection = Collection::whereSlug($slug)->first();
        $products = $collection->products()->get();

        return view('collection', compact('collections', 'collection', 'products'));
	}

}
