<?php namespace Quincalla\Http\Controllers;

use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Requests\StoreCartRequest;

class CheckoutController extends Controller {

    public function __construct()
    {
        $this->middleware('auth.checkout', [
            'except' => ['customer', 'postCustomer', 'shipping', 'postShipping']
        ]);
    }

    public function index()
    {
        return redirect()->route('checkout.shipping');
    }

    public function customer()
    {
        \Session::forget('checkout');
        return view('checkout.customer');
    }

    public function postCustomer()
    {
        $checkout = [
            'account_type' => \Request::get('account_type'),
            'order_id' => null
        ];
        session(['checkout' => $checkout]);

        return redirect()->route('checkout.shipping');
    }

    public function shipping()
    {
        $checkout = session('checkout');
        if (!$checkout) {
            $checkout = [
                'account_type' => 'existing',
                'account_id' => \Auth::user()->id,
                'order_id' => null
            ];

            session(['checkout' => $checkout]);
        }

        return view('checkout.shipping', compact('checkout'));
    }

    public function postShipping()
    {
        $checkout = session('checkout');
        $account_type = $checkout['account_type'];

        return redirect()->route('checkout.billing');

    }

    public function billing()
    {
        $checkout = session('checkout');

        return view('checkout.billing');
    }

    public function postBilling()
    {
        return redirect()->route('checkout.confirm');
    }

    public function confirm()
    {
        return view('checkout.confirm');
    }

}
