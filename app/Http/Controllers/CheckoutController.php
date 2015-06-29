<?php namespace Quincalla\Http\Controllers;

use Auth;
use Cart;
use DB;
use Request;
use Session;
use Quincalla\Entities\Checkout;
use Quincalla\Entities\Order;
use Quincalla\Entities\Product;
use Quincalla\Entities\Country;
use Quincalla\Entities\State;
use Quincalla\Entities\User;
use Quincalla\Http\Requests;
use Quincalla\Http\Requests\StoreCartRequest;
use Quincalla\Services\CheckoutCustomerLogin;
use Quincalla\Services\CheckoutStoreShipping;
use Webpatser\Countries\Countries;

class CheckoutController extends Controller {

    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->middleware('checkout', [
            'except' => ['customer', 'postCustomer' ]
        ]);

        $this->checkout = $checkout;
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

        $this->checkout->destroy();

        return view('checkout.customer');
    }

    public function postCustomer(CheckoutCustomerLogin $customerLogin)
    {
        return $customerLogin->run($this);
    }

    public function shipping()
    {
        $account_type = $this->checkout->get('checkout.type');

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
            $this->checkout->set('shipping.' .$key, $this->checkout->get('shipping.'.$key, Request::old($key)));
        }

        $this->checkout->set('shipping.account_email', $this->checkout->get('account.email', Request::old('account_email')));

        $countries = Country::orderBy('name')->lists('name', 'id');
        $states = State::orderBy('name')->lists('name', 'id');

        return view('checkout.shipping', compact('account_type', 'countries', 'states'))
            ->with($this->checkout->get('shipping'));
    }

    public function postShipping(CheckoutStoreShipping $storeShipping)
    {
        return $storeShipping->run($this);
    }

    public function billing()
    {
        if ( ! $this->checkout->has('shipping') || ! count($this->checkout->get('shipping'))) {
            return back()
                ->with('error', 'Invalid shipping address');
        }

        if ( ! $this->checkout->has('billing.same_address')) {
            $this->checkout->set('billing.same_address', 1);
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
            $this->checkout->set('billing.'.$key, $this->checkout->get('billing.'.$key, Request::old($key)));
        }

        $this->checkout->store();

        $countries = Country::orderBy('name')->lists('name', 'id');
        $states = State::orderBy('name')->lists('name', 'id');

        return view('checkout.billing', compact('account_type', 'countries', 'states'))
            ->with($this->checkout->get('billing'));
    }

    public function postBilling()
    {
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
            // $checkout['billing']['same_address'] = (int)Request::get('same_address');
            $this->checkout->set('billing.same_address', Request::get('same_address'));

            // TODO: Check if necesary
            $this->checkout->store();

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
            $billingAddress = $this->checkout->get('shipping');
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

        $this->checkout->set('account.name', $billingAddress['first_name'] . ' ' . $billingAddress['last_name']);
        $this->checkout->set('payment', $payment);
        $this->checkout->set('billing', $billingAddress);
        $this->checkout->set('billing.same_address', (int)Request::get('same_address'));

        if ($this->checkout->get('checkout.type') !== 'customer') {

            if ($this->checkout->get('checkout.type') === 'new-customer') {
                $role = 'customer';
                $password = $this->checkout->get('account.password');
                $active = true;

            } else {
                $role = 'guest';
                $password = '';
                $active = false;
            }

            $user = User::create([
                'role' => $role,
                'name' => $this->checkout->get('account.name'),
                'email' => $this->checkout->get('account.email'),
                'password' => $password,
                'active' => $active,
            ]);
        }

        // Create order
        $order = Order::create([
            'customer_email' => $this->checkout->get('account.email'),
            'customer_name' => $this->checkout->get('account.name'),
            'total_amount' => Cart::total(),
            'status' => 'new',
            'card_name' => $this->checkout->get('payment.name_on_card'),
            'card_type' => $this->checkout->get('payment.card_type'),
            'card_number' => $this->cardMasking($this->checkout->get('payment.card_number')),
            'shipping_address' => json_encode($this->checkout->get('shipping')),
            'billing_address' => json_encode($this->checkout->get('billing')),
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

        $this->checkout->store();

        // Session::put('checkout', $checkout);

        return redirect()->route('checkout.confirm');
    }

    public function confirm()
    {
        if (! $this->checkout->has('payment') || ! count($this->checkout->get('payment'))) {
            return back()->with('error', 'Invalid payment');
        }

        // $this->checkout->destroy();

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

    public function redirectToBilling()
    {
        return redirect()->route('checkout.billing');
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
