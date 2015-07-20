<?php

namespace Quincalla\Http\Controllers;

use Illuminate\Http\Request;
use Quincalla\Entities\Product;
use Quincalla\Http\Requests\StoreCartRequest;
use Quincalla\Entities\Cart;

class CartController extends Controller
{
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $products = $this->cart->content();
        $cartTotal = $this->cart->total();

        return view('cart', compact('products', 'cartTotal'));
    }

    public function store(Product $products, StoreCartRequest $request)
    {
        $product = $products->whereSlug($request->get('product'))
            ->first();

        $this->cart->associate('Product', 'Quincalla\Entities')->add(
            $product->id,
            $product->name,
            $request->get('qty', 1),
            $product->price
        );

        return $this->redirectBackWithMessage(
            'Product has been added to your shopping cart'
        );
    }

    public function update(Request $request)
    {
        $quantities = $request->get('quantities');

        foreach ($quantities as $rowId => $quantity) {
            $this->cart->update($rowId, $quantity);
        }

        return $this->redirectBackWithMessage(
            'Product quantity updated'
        );
    }

    public function remove($id)
    {
        $this->cart->remove($id);

        return $this->redirectBackWithMessage(
            'Product has been deleted from your shopping cart'
        );
    }

    public function destroy()
    {
        $this->cart->destroy();

        return $this->redirectBackWithMessage(
            'Your shopping cart is empty'
        );
    }

    public function redirectBackWithMessage($message)
    {
        return redirect()->back()
            ->with('success', $message);
    }
}
