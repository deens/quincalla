<?php namespace Quincalla\Http\Controllers;

use Auth;
use Cart;
use Request;
use Session;
use Quincalla\Product;
use Quincalla\Http\Requests;
use Quincalla\Http\Requests\StoreCartRequest;

class CheckoutController extends Controller {

    public function __construct()
    {
        $this->middleware('checkout', [
            'except' => ['customer', 'postCustomer' ]
        ]);
    }

    public function index()
    {
        return redirect()->route('checkout.shipping');
    }

    public function customer()
    {
        // Check if cart is empty
        if ( ! Cart::content()->count()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Please add products to your shopping cart');
        }

        Session::forget('checkout');

        return view('checkout.customer');
    }

    public function postCustomer()
    {
        $accountType = Request::get("account_type");

        if ($accountType === 'existing') {

            $existingAccountRules = [
                'email' => 'required',
                'password' => 'required'
            ];

            $validator = \Validator::make(Request::only(['email', 'password']), $existingAccountRules);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            $validUser = Auth::attempt([
                'email' => Request::get('email'),
                'password' => Request::get('password')
            ]);

            if (! $validUser) {
                return back()
                    ->with('error', 'Invalid email address or password');
            }

            $accountId = Auth::user()->id;
        } else {
            $accountId = 0;
        }

        if ($accountType !== 'existing' && $accountId > 0) {
            $accountType = 'existing';
            $accountId = 0;
        }

        $checkout = [
            'account_type' => $accountType,
            'order_id' => null,
            'account_id' => $accountId
        ];

        session(['checkout' => $checkout]);

        return redirect()->route('checkout.shipping');
    }

    public function shipping()
    {
        $checkout = session('checkout');
        $account_type = $checkout['account_type'];

        return view('checkout.shipping', compact('checkout', 'account_type'));
    }

    public function postShipping()
    {
        $checkout = session('checkout');
        $accountType = $checkout['account_type'];

        $shippginRules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'phone' => 'required',
        ];

        if ($accountType !== 'existing') {
            $checkout['account_email'] = Request::get('email');
            $shippginRules['email'] = 'required';
        }

        if ($accountType === 'new') {
            $checkout['account_password'] = \Hash::make(Request::get('password'));
            $shippginRules['password'] = 'required|confirmed';
        }

        $validator = \Validator::make(Request::all(), $shippginRules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $shippingAddress = [
            'first_name' => Request::get('first_name'),
            'last_name' => Request::get('last_name'),
            'full_name' => Request::get('first_name') . ' ' . Request::get('last_name'),
            'address' => Request::get('address'),
            'address1' => Request::get('address1'),
            'country' => Request::get('country'),
            'state' => Request::get('state'),
            'phone' => Request::get('phone'),
            'zipcode' => Request::get('zipcode')
        ];

        $checkout['shipping'] = $shippingAddress;

        Session::put('checkout', $checkout);


        return redirect()->route('checkout.billing');
    }

    public function billing()
    {
        $checkout = session('checkout');

        if (! isset($checkout['shipping']) || !count($checkout['shipping'])) {
            return back()
                ->with('error', 'Invalid shipping address');
        }

        return view('checkout.billing', compact('checkout'));
    }

    public function postBilling()
    {
        $checkout = session('checkout');
        $billingRules = [
            'name_on_cart' => 'required',
            'cart_number' => 'required',
            'expiration_date_month' => 'required',
            'expiration_date_year' => 'required',
            'ccv_code' => 'required'
        ];

        $payment = [
            'name_on_cart' => Request::get('name_on_cart'),
            'cart_number' => Request::get('cart_number'),
            'cart_type' => Request::get('cart_type'),
            'expiration_date_month' => Request::get('expiration_date_month'),
            'expiration_date_year' => Request::get('expiration_date_year'),
            'ccv_code' => Request::get('ccv_code')
        ];

        if (Request::get('same_address')) {
            $billingAddress = $checkout['shipping'];
        } else {
            $billingAddress = [
                'first_name' => Request::get('first_name'),
                'last_name' => Request::get('last_name'),
                'full_name' => Request::get('first_name') . ' ' . Request::get('last_name'),
                'address' => Request::get('address'),
                'address1' => Request::get('address1'),
                'country' => Request::get('country'),
                'city' => Request::get('city'),
                'phone' => Request::get('phone'),
                'zipcode' => Request::get('zipcode')
            ];
        }

        $checkout['account_name'] = $billingAddress['full_name'];
        $checkout['payment'] = $payment;
        $checkout['billing'] = $billingAddress;

        Session::put('checkout', $checkout);

        return redirect()->route('checkout.confirm');
    }

    public function confirm()
    {
        $checkout = session('checkout');

        if (! isset($checkout['payment']) || ! count($checkout['payment'])) {
            return back()->with('error', 'Invalid payment');
        }

        return view('checkout.confirm', compact('checkout'));
    }

}
