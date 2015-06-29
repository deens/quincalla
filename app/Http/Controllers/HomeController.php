<?php
namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Collection;
use Quincalla\Entities\Product;

class HomeController extends Controller {

    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->take(4)->get();

        return view('home', compact('products'));
    }

}
