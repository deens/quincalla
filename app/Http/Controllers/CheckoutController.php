<?php namespace Quincalla\Http\Controllers;

use Auth;
use Cart;
use Request;
use Session;
use Quincalla\Address;
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
        $accountType = Request::get('account_type');

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

        $shippingFields = [
            'first_name',
            'last_name',
            'email',
            'address',
            'address1',
            'city',
            'state',
            'country',
            'zipcode',
            'phone'
        ];
        foreach($shippingFields as $key)
        {
            $checkout['shipping'][$key] = isset($checkout['shipping'][$key]) ? $checkout['shipping'][$key] : Request::old($key);
        }

        $checkout['shipping']['account_email'] = isset($checkout['account_email']) ? $checkout['account_email'] : Request::old('account_email');

        return view('checkout.shipping', compact('checkout', 'account_type'))->with($checkout['shipping']);
    }

    public function postShipping()
    {
        $checkout = session('checkout');
        $accountType = $checkout['account_type'];

        $shippingRules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required|not_in:0',
            'country' => 'required|not_in:0',
            'zipcode' => 'required',
            'phone' => 'required'
        ];

        if ($accountType !== 'existing') {
            $checkout['account_email'] = Request::get('account_email');
            $shippingRules['account_email'] = 'required';
        }

        if ($accountType === 'new') {
            $checkout['account_password'] = \Hash::make(Request::get('password'));
            $shippingRules['password'] = 'required|confirmed';
        }

        $validator = \Validator::make(Request::all(), $shippingRules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $shippingAddress = [
            'first_name' => Request::get('first_name'),
            'last_name' => Request::get('last_name'),
            'address' => Request::get('address'),
            'address1' => Request::get('address1'),
            'state' => Request::get('state'),
            'city' => Request::get('city'),
            'country' => Request::get('country'),
            'phone' => Request::get('phone'),
            'zipcode' => Request::get('zipcode')
        ];

        $checkout['shipping'] = $shippingAddress;

        if ( ! isset($checkout['billing'])) {
            $checkout['billing'] = $shippingAddress;
            $checkout['billing']['same_address'] = 1;
        }

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

        $billingFields = [
            'first_name',
            'last_name',
            'email',
            'address',
            'address1',
            'city',
            'state',
            'country',
            'zipcode',
            'phone',
            'same_address'
        ];
        foreach($billingFields as $key)
        {
            $checkout['billing'][$key] = isset($checkout['billing'][$key]) ? $checkout['billing'][$key] : Request::old($key);
        }

        return view('checkout.billing', compact('checkout'))->with($checkout['billing']);
    }

    public function postBilling()
    {
        $checkout = session('checkout');

        $billingRules = [
            'name_on_card' => 'required',
            'card_number' => 'required',
            'expiration_date_month' => 'required',
            'expiration_date_year' => 'required',
            'ccv_code' => 'required',
            'card_type' => 'required|not_in:0'
        ];

        if ( ! Request::get('same_address')) {
            $billingRules += [
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required|not_in:0',
                'country' => 'required|not_in:0',
                'zipcode' => 'required',
                'phone' => 'required'
            ];
        }

        $validator = \Validator::make(Request::all(), $billingRules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
                'city' => Request::get('city'),
                'state' => Request::get('state'),
                'country' => Request::get('country'),
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
