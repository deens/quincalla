<?php

namespace Quincalla\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Quincalla\Entities\Checkout;

class CheckoutShipping extends Job implements SelfHandling
{
    public $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Address $address, Checkout $checkout, Hash $hash)
    {
        $checkout->set('account.email', $this->request->get('account_email'));
        $checkout->set('account.password', $this->request->get('password'));

        foreach ($this->addressFields() as $field) {
            $shippingData[$field] = $this->request->get($field);
        }

        $this->checkout->set('shipping', $shippingData);
        $this->checkout->store();
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
