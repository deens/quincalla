<?php namespace Quincalla\Http\Controllers;

use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller {

	public function index()
	{
        $products = \Cart::content();
        $cartTotal = \Cart::total();

        return view('cart', compact('products', 'cartTotal'));
	}

	public function store()
	{
        $product = Product::whereSlug(\Request::get('product'))->first();
        \Cart::add($product->id, $product->name, \Request::get('qty', 1), $product->price);

        return redirect()->route('cart.index')->with('success', 'Product has been added to your shopping bag');
	}

	public function update($id)
	{
        \Cart::update($id, \Request::get('qty'));

        return redirect()->route('cart.index')->with('success', 'Product quantity updated');
	}

	public function destroy($id)
	{
        \Cart::remove($id);

        return redirect()->route('cart.index')->with('success', 'Product has beeen deleted from your Shopping bag');
	}

}
