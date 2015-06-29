<?php 
namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Collection;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionsController extends Controller {

	public function show($slug)
	{
        $collection = Collection::whereSlug($slug)->first();
        $products = $collection->products()->simplePaginate(6);

        return view('collection', compact('collection', 'products'));
	}

}
