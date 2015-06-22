<?php namespace Quincalla\Http\Controllers;

use Auth;
use Cart;
use DB;
use Request;
use Session;
use Quincalla\Order;
use Quincalla\Product;
use Quincalla\User;
use Quincalla\Http\Requests;
use Quincalla\Http\Requests\StoreCartRequest;
use Quincalla\Services\CheckoutCustomerLogin;

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
        if ( ! Cart::content()->count()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Please add products to your shopping cart');
        }

        Session::forget('checkout');

        return view('checkout.customer');
    }

    public function postCustomer(CheckoutCustomerLogin $customerLogin)
    {
        return $customerLogin->run($this);
    }

    public function shipping()
    {
        $checkout = session('checkout');
        $account_type = $checkout['checkout']['type'];

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

        return view('checkout.shipping', compact('account_type'))->with($checkout['shipping']);
    }

    public function postShipping()
    {
        $checkout = session('checkout');
        $accountType = $checkout['checkout']['type'];

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

        if ($accountType !== 'customer') {
            $checkout['account_email'] = Request::get('account_email');
            $shippingRules['account_email'] = 'required';
        }

        if ($accountType === 'new-customer') {
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

        if ( ! isset($checkout['billing']['same_address'])) {
            $checkout['billing']['same_address'] = 1;
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
            'phone'
        ];
        foreach($billingFields as $key)
        {
            $checkout['billing'][$key] = isset($checkout['billing'][$key]) ? $checkout['billing'][$key] : Request::old($key);
        }

        return view('checkout.billing')->with($checkout['billing']);
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
            $checkout['billing']['same_address'] = (int)Request::get('same_address');
            Session::put('checkout', $checkout);

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment = [
            'name_on_card' => Request::get('name_on_card'),
            'card_number' => Request::get('card_number'),
            'card_type' => Request::get('card_type'),
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
                'address' => Request::get('address'),
                'address1' => Request::get('address1'),
                'city' => Request::get('city'),
                'state' => Request::get('state'),
                'country' => Request::get('country'),
                'phone' => Request::get('phone'),
                'zipcode' => Request::get('zipcode')
            ];
        }

        $checkout['account_name'] = $billingAddress['first_name'] . ' ' . $billingAddress['last_name'];
        $checkout['payment'] = $payment;
        $checkout['billing'] = $billingAddress;
        $checkout['billing']['same_address'] = (int)Request::get('same_address');

        if ($checkout['checkout']['type'] !== 'customer') {

            if ($checkout['checkout']['type'] === 'new-customer') {
                $role = 'customer';
                $password = $checkout['account_password'];
                $active = true;

            } else {
                $role = 'guest';
                $password = '';
                $active = false;
            }

            $user = User::create([
                'role' => $role,
                'name' => $checkout['account']['name'],
                'email' => $checkout['account']['email'],
                'password' => $password,
                'active' => $active,
            ]);
        }

        // Create order
        $order = Order::create([
            'customer_email' => $checkout['account']['email'],
            'customer_name' => $checkout['account']['name'],
            'total_amount' => Cart::total(),
            'status' => 'new',
            'card_name' => $checkout['payment']['name_on_card'],
            'card_type' => $checkout['payment']['card_type'],
            'card_number' => $this->cardMasking($checkout['payment']['card_number']),
            'shipping_address' => json_encode($checkout['shipping']),
            'billing_address' => json_encode($checkout['billing']),
        ]);

        // Create order products
        $cartContent = Cart::content();

        foreach ($cartContent as $item) {
            $order->items()->create([
                'product_id' => $item->id,
                'product_name' => $item->name,
                'attributes' => json_encode($item->options),
                'quantity' => $item->qty,
                'price' => $item->price,
            ]);
        }

        // Cart::clean();

        Session::put('checkout', $checkout);

        return redirect()->route('checkout.confirm');
    }

    public function confirm()
    {
        $checkout = session('checkout');

        if (! isset($checkout['payment']) || ! count($checkout['payment'])) {
            return back()->with('error', 'Invalid payment');
        }

        //Session::forget('checkout');

        return view('checkout.confirm');
    }

    private function cardMasking($number)
    {
        return str_repeat("*", strlen($number) - 4) . substr($number, -4);
    }

    public function redirectToShipping()
    {
        return redirect()->route('checkout.shipping');
    }

    public function redirectBackWithMessage($message)
    {
        return redirect()->back()->with('error', $message);
    }

    public function redirectBackWithValidationErrors($validator)
    {
        return redirect()->back()->withErrors($validator->errors())->withInput();
    }

    public function redirectBackWithInvalidCredentials()
    {
        return redirect()->back()->with('error', 'Invalid email or password');
    }
}
