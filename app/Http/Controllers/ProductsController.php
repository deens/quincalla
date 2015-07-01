<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    protected $products;

    public function __construct(Product $products)
    {
        $this->products = $products;
    }

	public function show($slug)
	{
        $product = $this->products->with('collection')
            ->whereSlug($slug)
            ->first();

        return view('product', compact('product'));
	}
}
