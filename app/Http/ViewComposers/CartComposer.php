<?php 

namespace Quincalla\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Quincalla\Collection;

class CartComposer
{

    public function compose(View $view)
    {
        $view->with('cart_total', \Cart::total());
        $view->with('cart_count', \Cart::count() ?: 0 );
    }
}

