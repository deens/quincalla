<?php

namespace Quincalla\Http\Controllers;

use Illuminate\Http\Request;
use Quincalla\Entities\State;
use Quincalla\Entities\Address;
use Quincalla\Entities\Country;
use Quincalla\Entities\Checkout;

class OrderDeliveryController extends Controller
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
        $address = new Address();
        $address->name = $request->user()->name;

        $states = State::orderBy('name')->pluck('name', 'id');
        $countries = Country::orderBy('name')->pluck('name', 'id');
        $shipping = null;

        return view('order.delivery', compact('states', 'countries', 'address', 'shipping'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Checkout $checkout)
    {
        $fields = Address::getFields();

        foreach ($fields as $field) {
            $checkout->set('delivery.'.$field, $request->get($field));
        }

        $checkout->store();

        return redirect()->route('order.payment.create');
    }

}
