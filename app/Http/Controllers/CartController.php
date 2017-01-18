<?php

namespace Quincalla\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use Quincalla\Entities\Product;
use Quincalla\Http\Requests\StoreCartRequest;

class CartController extends Controller
{
    public function index()
    {
        $products = Cart::content();
        $cartTotal = Cart::total();
        $taxTotal = Cart::tax();
        $cartSubtotal = Cart::subtotal();

        return view('cart', compact('products', 'cartSubtotal', 'cartTotal', 'taxTotal'));
    }

    public function store(StoreCartRequest $request)
    {
        $product = Product::published()
            ->whereSlug($request->get('product'))
            ->first();

        Cart::add($product, $request->get('qty', 1));

        return $this->redirectBackWithMessage(
            'Product has been added to your cart.'
        );
    }

    public function update(Request $request)
    {
        $quantities = $request->get('quantities');

        foreach ($quantities as $rowId => $quantity) {
            Cart::update($rowId, $quantity);
        }

        return $this->redirectBackWithMessage('Product quantity has been updated.');
    }

    public function remove($id)
    {
        Cart::remove($id);

        return $this->redirectBackWithMessage('Product has been deleted from your cart.');
    }

    public function destroy()
    {
        Cart::destroy();

        return $this->redirectBackWithMessage('Your cart is empty.');
    }

    public function redirectBackWithMessage($message)
    {
        return redirect()->back()
            ->with('success', $message);
    }
}
