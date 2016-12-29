<?php

namespace Quincalla\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Quincalla\Entities\Address;
use Quincalla\Entities\Checkout;
use Quincalla\Entities\Country;
use Quincalla\Entities\State;
use Quincalla\Entities\User;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('order.auth', ['except' => [
            'customer',
            'postCustomer',
            'register',
            'postRegister',
        ]]);
    }

    public function index()
    {
        return redirect()->route('order.delivery');
    }

    public function customer()
    {
        return view('order.customer');
    }

    public function postCustomer(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'active' => true,
        ], $request->get('remember'))) {
            return redirect()->intended('order.delivery');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function register()
    {
        if (Auth::guest()) {
            $user = new User();
        } else {
            $user = Auth::user();
        }

        return view('order.register', compact('user'));
    }

    public function postRegister(Request $request, User $user)
    {
        if (Auth::guest()) {
            //  register a new user
            $newUser = $user->create([
                'name'     => $request->get('first_name').' '.$request->get('last_name'),
                'email'    => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'active'   => true,
            ]);
            // authenticate new user
            Auth::login($newUser);
        }

        return redirect()->route('order.delivery');
    }

    public function delivery()
    {
        $address = new Address();
        $address->name = Auth::user()->name;
        $states = State::orderBy('name')->lists('name', 'id');
        $countries = Country::orderBy('name')->lists('name', 'id');
        $shipping = null;

        return view('order.delivery', compact('states', 'countries', 'address', 'shipping'));
    }

    public function postDelivery(Request $request, Checkout $checkout)
    {
        $fields = Address::getFields();
        foreach ($fields as $field) {
            $checkout->set('delivery.'.$field, $request->get($field));
        }

        $checkout->store();

        return redirect()->route('order.payment');
    }

    public function payment()
    {
        $sameAddress = true;
        $address = new Address();
        $address->name = Auth::user()->name;
        $states = State::orderBy('name')->lists('name', 'id');
        $countries = Country::orderBy('name')->lists('name', 'id');

        return view('order.payment', compact('sameAddress', 'address', 'states', 'countries'));
    }

    public function postPayment(Request $request)
    {
        return redirect()->route('order.confirm');
    }

    public function confirm()
    {
        return view('order.confirm');
    }
}
