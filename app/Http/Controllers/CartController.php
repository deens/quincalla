<?php namespace Quincalla\Http\Controllers;

use Cart;
use Request;
use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Requests\StoreCartRequest;

class CartController extends Controller {

    public function index()
    {
        $products = Cart::content();
        $cartTotal = Cart::total();

        return view('cart', compact('products', 'cartTotal'));
    }

    public function store(StoreCartRequest $request)
    {
        $product = Product::whereSlug(\Request::get('product'))->first();

        Cart::associate('Product', 'Quincalla')->add(
            $product->id, 
            $product->name, 
            \Request::get('qty', 1), 
            $product->price
        );

        return $this->redirectBackWithMessage('Product has been added to your shopping bag');
    }

    public function update()
    {
        $quantities = \Request::get('quantities');

        foreach ($quantities as $rowId => $quantity) {
            Cart::update($rowId, $quantity);
        }

        return $this->redirectBackWithMessage('Product quantity updated');
    }

    public function remove($id)
    {
        Cart::remove($id);

        return $this->redirectBackWithMessage('Product has been deleted from your Shopping bag');
    }

    public function destroy()
    {
        Cart::destroy();

        return $this->redirectBackWithMessage('Your shopping cart is empty');
    }

    public function redirectBackWithMessage($message)
    {
        return redirect()->back()->with('success', $message);
    }

}
