<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::published()
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('products'));
    }
}
