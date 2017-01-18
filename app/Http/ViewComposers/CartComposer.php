<?php

namespace Quincalla\Http\ViewComposers;

use Cart;
use Illuminate\Contracts\View\View;

class CartComposer
{
    public function compose(View $view)
    {
        $view->with('cart_total', Cart::total());
        $view->with('cart_count', Cart::count() ?: 0);
    }
}
