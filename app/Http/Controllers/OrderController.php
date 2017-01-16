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
        return redirect()->route('order.delivery.create');
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
            return redirect()->route('order.delivery.create');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function register()
    {
        $user = (Auth::guest()) ? new User() : Auth::user();

        return view('order.register', compact('user'));
    }

    public function postRegister(Request $request)
    {
        if (Auth::guest()) {
            //  register a new user
            $newUser = User::create([
                'name'     => $request->get('first_name').' '.$request->get('last_name'),
                'email'    => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'active'   => true,
            ]);

            // authenticate new user
            Auth::login($newUser);
        }

        return redirect()->route('order.delivery.create');
    }

    public function confirm()
    {
        return view('order.confirm');
    }
}
