<?php

namespace Quincalla\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Quincalla\Entities\Cart;

class CartComposer
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function compose(View $view)
    {
        $view->with('cart_total', $this->cart->total());
        $view->with('cart_count', $this->cart->count() ?: 0);
    }
}
