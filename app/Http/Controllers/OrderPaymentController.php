<?php

namespace Quincalla\Http\Controllers;

use Illuminate\Http\Request;
use Quincalla\Entities\State;
use Quincalla\Entities\Address;
use Quincalla\Entities\Country;
use Quincalla\Entities\Checkout;

class OrderPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('order.auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sameAddress = true;
        $address = new Address();
        $address->name = $request->user()->name;

        $states = State::orderBy('name')->pluck('name', 'id');
        $countries = Country::orderBy('name')->pluck('name', 'id');

        return view('order.payment', compact('sameAddress', 'states', 'countries', 'address'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Checkout $checkout)
    {
        // check if sameAddress true and copy delivery into shipping.

        return redirect()->route('order.confirm');
    }
}
