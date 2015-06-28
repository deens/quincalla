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

        // Trim values except password & password_confirmation
        $this->request->merge(array_map('trim', $this->request->except('password', 'password_confirmation')));

        // Get account type
        $accountType = $this->checkout->get('checkout.type');

        // Define shipping rules
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

        // Save account information
        $this->checkout->set('account.email', $this->request->get('account_email', ''));
        $this->checkout->set('account.password', $this->hash->make($this->request->get('password', '')));

        // Save shipping information
        $shippingData = [
            'address1' => $this->request->get('address1')
        ];
        foreach($shippingRules as $field => $rule) {
            $shippingData[$field] = $this->request->get($field);
        }
        $this->checkout->set('shipping', $shippingData);
        $this->checkout->store();

        return $this->listener->redirectToBilling();
    }
}
