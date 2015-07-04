<?php
namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Collection;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    protected $collections;

    public function __construct(Collection $collections)
    {
        $this->collections = $collections;
    }

	public function show($slug)
	{
        $collection = $this->collections->whereSlug($slug)
            ->first();

        $products = $collection->products()
            ->simplePaginate(6);

        return view('collection', compact(
            'collection',
            'products'
        ));
	}
}
