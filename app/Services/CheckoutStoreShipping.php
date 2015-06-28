<?php

namespace Quincalla\Services;

use Illuminate\Http\Request;
use Quincalla\Checkout;
use Illuminate\Validation\Factory;
use Illuminate\Contracts\Hashing\Hasher;

class CheckoutStoreShipping
{
    protected $request;
    protected $checkout;
    protected $validator;
    protected $listener;

    public function __construct(Request $request, Checkout $checkout, Factory $validator, Hasher $hash)
    {
        $this->request = $request;
        $this->checkout = $checkout;
        $this->validator = $validator;
        $this->hash = $hash;
    }

    public function run($listener)
    {
        $this->listener = $listener;

        $accountType = $this->checkout->get('checkout.type');

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

        if ($accountType === 'new-customer' || $accountType === 'guest') {
            $shippingRules['account_email'] = 'required';
        }

        if ($accountType === 'new-customer') {
            $shippingRules['password'] = 'required|confirmed';
        }

        $validator = $this->validator->make($this->request->all(), $shippingRules);

        if ($validator->fails()) {
            return $this->listener->redirectBackWithValidationErrors($validator);
        }

        if ($accountType === 'new-customer' || $accountType === 'guest') {
            $this->checkout->set('account.email', $this->request->get('account_email', ''));
        }

        if ($accountType === 'new-customer') {
            $this->checkout->set('account.password', $this->hash->make($this->request->get('password', '')));
        }

        $this->checkout->set('shipping', [
            'first_name' => $this->request->get('first_name'),
            'last_name' => $this->request->get('last_name'),
            'address' => $this->request->get('address'),
            'address1' => $this->request->get('address1'),
            'state' => $this->request->get('state'),
            'city' => $this->request->get('city'),
            'country' => $this->request->get('country'),
            'phone' => $this->request->get('phone'),
            'zipcode' => $this->request->get('zipcode')
        ]);

        $this->checkout->store();

        return $this->listener->redirectToBilling();
    }
}
