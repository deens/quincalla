<?php 
namespace Quincalla\Http\Controllers;

use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller {

	public function show($slug)
	{
        $product = Product::with('collection')->whereSlug($slug)->first();

        return view('product', compact('product'));
	}
}
