<?php

namespace Quincalla\Http\Controllers;

use Illuminate\Http\Request;
use Quincalla\Entities\Cart;
use Quincalla\Entities\Checkout;
use Quincalla\Entities\Country;
use Quincalla\Entities\State;
use Quincalla\Services\CheckoutCustomerLogin;
use Quincalla\Services\CheckoutStoreShipping;
use Quincalla\Services\CheckoutStoreBilling;
use Webpatser\Countries\Countries;

class CheckoutController extends Controller
{
    protected $checkout;
    protected $countries;
    protected $states;

    public function __construct(
        Checkout $checkout,
        Country $countries,
        State $states
    ) {
        $this->middleware('checkout', [
            'except' => ['customer', 'postCustomer'],
        ]);

        $this->checkout = $checkout;
        $this->countries = $countries;
        $this->states = $states;
    }

    public function index()
    {
        return redirect()->route('checkout.shipping');
    }

    public function customer(Cart $cart)
    {
        if (!$cart->content()->count()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Please add products to your shopping cart');
        }

        $this->checkout->destroy();

        return view('checkout.customer');
    }

    public function postCustomer(CheckoutCustomerLogin $checkoutCustomerLogin)
    {
        return $checkoutCustomerLogin->run($this);
    }

    public function shipping(Request $request)
    {
        $accountType = $this->checkout->get('checkout.type');

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
            'phone',
        ];

        foreach ($shippingFields as $key) {
            $shippingKey = 'shipping.'.$key;
            $this->checkout->set(
                $shippingKey,
                $this->checkout->get($shippingKey, $request->old($key))
            );
        }

        $this->checkout->set(
            'shipping.account_email',
            $this->checkout->get(
                'account.email',
                $request->old('account_email')
            )
        );

        $countries = $this->countries->orderBy('name')
            ->lists('name', 'id');
        $states = $this->states->orderBy('name')
            ->lists('name', 'id');

        return view('checkout.shipping', compact('countries', 'states'))
            ->with('account_type', $accountType)
            ->with($this->checkout->get('shipping'));
    }

    public function postShipping(CheckoutStoreShipping $storeShipping)
    {
        return $storeShipping->run($this);
    }

    public function billing(Request $request)
    {
        if (
            !$this->checkout->has('shipping')
            || !count($this->checkout->get('shipping'))
        ) {
            return back()->with('error', 'Invalid shipping address');
        }

        if (!$this->checkout->has('billing.same_address')) {
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
            'phone',
        ];

        foreach ($billingFields as $key) {
            $billingKey = 'billing.'.$key;
            $this->checkout->set(
                $billingKey,
                $this->checkout->get($billingKey, $request->old($key))
            );
        }

        $this->checkout->store();

        $countries = $this->countries->orderBy('name')
            ->lists('name', 'id');
        $states = $this->states->orderBy('name')
            ->lists('name', 'id');

        return view('checkout.billing', compact('countries', 'states'))
            ->with($this->checkout->get('billing'));
    }

    public function postBilling(CheckoutStoreBilling $storeBilling)
    {
        return $storeBilling->run($this);
    }

    public function confirm()
    {
        if (
            !$this->checkout->has('payment')
            || !count($this->checkout->get('payment'))
        ) {
            return back()->with('error', 'Invalid payment');
        }

        return view('checkout.confirm');
    }

    /**
     * Listener Responders.
     */
    public function redirectToShipping()
    {
        return redirect()->route('checkout.shipping');
    }

    public function redirectToBilling()
    {
        return redirect()->route('checkout.billing');
    }

    public function redirectToConfirmation()
    {
        return redirect()->route('checkout.confirm');
    }

    public function redirectBackWithMessage($message)
    {
        return redirect()->back()
            ->with('error', $message);
    }

    public function redirectBackWithValidationErrors($validator)
    {
        return redirect()->back()
            ->withErrors($validator->errors())->withInput();
    }

    public function redirectBackWithInvalidCredentials()
    {
        return redirect()->back()
            ->with('error', 'Invalid email or password');
    }
}
