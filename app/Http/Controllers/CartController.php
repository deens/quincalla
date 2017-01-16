<?php

namespace Quincalla\Http\Controllers;

use Illuminate\Http\Request;
use Quincalla\Entities\Cart;
use Quincalla\Entities\Product;
use Quincalla\Http\Requests\StoreCartRequest;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    protected $cart;

    /**
     * CartController constructor.
     *
     * @param Cart $cart
     */
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

    /**
     * @param Product          $products
     * @param StoreCartRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Product $products, StoreCartRequest $request)
    {
        $product = $products->whereSlug($request->get('product'))->first();

        $this->cart->add($product, $request->get('qty', 1));

        return $this->redirectBackWithMessage(
            'Product has been added to your cart.'
        );
    }

    public function update(Request $request)
    {
        $quantities = $request->get('quantities');

        foreach ($quantities as $rowId => $quantity) {
            $this->cart->update($rowId, $quantity);
        }

        return $this->redirectBackWithMessage(
            'Product quantity has been updated.'
        );
    }

    public function remove($id)
    {
        $this->cart->remove($id);

        return $this->redirectBackWithMessage(
            'Product has been deleted from your cart.'
        );
    }

    public function destroy()
    {
        $this->cart->destroy();

        return $this->redirectBackWithMessage(
            'Your cart is empty.'
        );
    }

    public function redirectBackWithMessage($message)
    {
        return redirect()->back()
            ->with('success', $message);
    }
}
