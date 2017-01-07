<?php

namespace Quincalla\Services;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Http\Request;
use Quincalla\Entities\Checkout;
use Quincalla\Http\Controllers\CheckoutController;

class CheckoutStoreShipping
{
    protected $request;
    protected $checkout;
    protected $hash;

    public function __construct(
        Request $request,
        Checkout $checkout,
        Hasher $hash
    ) {
        $this->request = $request;
        $this->checkout = $checkout;
        $this->hash = $hash;
    }

    public function run(CheckoutController $listener)
    {
        // Trim values except password & password_confirmation
        $this->request->merge(array_map('trim', $this->request->except('password', 'password_confirmation')));

        // Save account information
        $this->checkout->set('account.email', $this->request->get('account_email', ''));
        $this->checkout->set('account.password', $this->hash->make($this->request->get('password', '')));

        $shippingData = [];
        foreach ($this->addressFields() as $field) {
            $shippingData[$field] = $this->request->get($field);
        }

        $this->checkout->set('shipping', $shippingData);
        $this->checkout->store();

        return $listener->redirectToBilling();
    }

    public function addressFields()
    {
        return [
            'first_name',
            'last_name',
            'address',
            'address1',
            'city',
            'state',
            'country',
            'zipcode',
            'phone',
        ];
    }
}
