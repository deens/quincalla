<?php

namespace Quincalla\Http\Controllers;

use Quincalla\Entities\Order;

class AccountController extends Controller
{
    protected $orders;

    public function __construct(Order $orders)
    {
        $this->middleware('auth');
        $this->orders = $orders;
    }

    public function index()
    {
        $orders = $this->orders->where('customer_email', \Auth::user()->email)
            ->take(5)
            ->get();

        return view('account', compact('orders'));
    }
}
