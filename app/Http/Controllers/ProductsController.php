<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Product;

class ProductsController extends Controller
{
    public function show($slug)
    {
        $product = Product::with('collections')
            ->published()
            ->whereSlug($slug)
            ->firstOrFail();

        return view('product', compact('product'));
    }
}
