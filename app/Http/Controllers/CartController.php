<?php

namespace Quincalla\Http\Controllers;

use Cart;
use Request;
use Quincalla\Entities\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Requests\StoreCartRequest;
use Illuminate\Http\Response;

class CartController extends Controller
{
    /**
     * Returns all items in cart
     */
    public function index()
    {
        $products = Cart::content();
        $cartTotal = Cart::total();

        return view('cart', compact('products', 'cartTotal'));
    }

    /**
     * Add new item to cart
     *
     * @param Quincalla\Entities\Product $product
     * @param Quincalla\Http\Requests\StoreCartRequest $request
     */
    public function store(Product $products, StoreCartRequest $request)
    {
        $product = $products->whereSlug($request->get('product'))
            ->first();

        Cart::associate('Product', 'Quincalla\Entities')->add(
            $product->id,
            $product->name,
            $request->get('qty', 1),
            $product->price
        );

        return $this->redirectBackWithMessage(
            'Product has been added to your shopping cart'
        );
    }

    /**
     * Update item quantity
     */
    public function update()
    {
        $quantities = \Request::get('quantities');

        foreach ($quantities as $rowId => $quantity) {
            Cart::update($rowId, $quantity);
        }

        return $this->redirectBackWithMessage(
            'Product quantity updated'
        );
    }

    /**
     * Remove item from cart
     *
     * @param int $id
     */
    public function remove($id)
    {
        Cart::remove($id);

        return $this->redirectBackWithMessage(
            'Product has been deleted from your shopping cart'
        );
    }

    /**
     * Destroy shopping cart content
     */
    public function destroy()
    {
        Cart::destroy();

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
