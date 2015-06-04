<?php namespace Quincalla\Http\Controllers;

use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Requests\StoreCartRequest;

class CheckoutController extends Controller {

    public function index()
    {
        return view('checkout.customer');
    }

    public function postCustomer()
    {
        return redirect()->route('checkout.shipping');
    }

    public function shipping()
    {
        return view('checkout.shipping');
    }

    public function postShipping()
    {
        return redirect()->route('checkout.billing');
    }

    public function billing()
    {
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
