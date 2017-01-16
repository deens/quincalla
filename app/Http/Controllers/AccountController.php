<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Order;

class AccountController extends Controller
{
    public function index()
    {
        $orders = Order::where('customer_email', \Auth::user()->email)
            ->take(5)
            ->get();

        return view('account', compact('orders'));
    }
}
