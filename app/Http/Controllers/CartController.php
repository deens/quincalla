<?php namespace Quincalla\Http\Controllers;

use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Controllers\Controller;
use Quincalla\Http\Requests\StoreCartRequest;
use Illuminate\Http\Request;

class CartController extends Controller {

    public function index()
    {
        $products = \Cart::content();
        $cartTotal = \Cart::total();

        return view('cart', compact('products', 'cartTotal'));
    }

    public function store(StoreCartRequest $request)
    {
        $product = Product::whereSlug(\Request::get('product'))->first();
        \Cart::add($product->id, $product->name, \Request::get('qty', 1), $product->price);

        return redirect()->route('cart.index')->with('success', 'Product has been added to your shopping bag');
    }

    public function update()
    {
        $quantities = \Request::get('quantities');

        foreach ($quantities as $rowid => $quantity) {
            \Cart::update($rowid, $quantity);
        }

        return redirect()->route('cart.index')->with('success', 'Product quantity updated');
    }

    public function destroy($id)
    {
        \Cart::remove($id);

        return redirect()->route('cart.index')->with('success', 'Product has beeen deleted from your Shopping bag');
    }

}
