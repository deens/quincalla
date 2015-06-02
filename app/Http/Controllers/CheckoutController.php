<?php namespace Quincalla\Http\Controllers;

use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Requests\StoreCartRequest;

class CheckoutController extends Controller {

    public function index()
    {
        return view('checkout');
    }

}