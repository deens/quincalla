<?php

namespace Quincalla\Services;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use Illuminate\Validation\Factory as Validator;
use Quincalla\Entities\Checkout;

class Checkoutcustomerlogin
{
    protected $request;
    protected $validator;
    protected $auth;
    protected $listener;
    protected $checkout;
    protected $credentials = [];
    protected $accountTypes = [
            'customer',
            'guest',
            'new-customer',
    ];

    public function __construct(
        Checkout $checkout,
        Request $request,
        Guard $auth,
        Validator $validator
    ) {
        $this->checkout = $checkout;
        $this->request = $request;
        $this->auth = $auth;
        $this->validator = $validator;
    }

    public function run($listener)
    {
        $this->listener = $listener;

        if (!$this->validAccountType($this->request->get('account_type'))) {
            return $this->listener->redirectBackWithMessage(
                'Invalid Account Type Selected'
            );
        }

        $this->checkout->set(
            'checkout.type',
            $this->request->get('account_type')
        );

        if ($this->checkout->get('checkout.type') === 'customer') {
            return $this->customerLogin();
        }

        $this->checkout->store();

        return $this->listener->redirectToShipping();
    }

    public function customerLogin()
    {
        $credentials = [
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password'),
        ];

        $validator = $this->customerLoginValidator($credentials);

        if ($validator->fails()) {
            return $this->listener->redirectBackWithValidationErrors($validator);
        }

        $credentials['active'] = true;

        $customer = $this->auth->attempt($credentials);

        if (!$customer) {
            return $this->listener->redirectBackWithInvalidCredentials();
        }

        $this->checkout->set('account.id', $this->auth->user()->id);
        $this->checkout->set('account.email', $this->auth->user()->email);

        $this->checkout->store();

        return $this->listener->redirectToShipping();
    }

    public function customerLoginValidator($credentials)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        return $this->validator->make($credentials, $rules);
    }

    /**
     * Verify if checkout account type is valid.
     *
     * @param string $type account type
     *
     * @return boolen
     */
    private function validAccountType($type)
    {
        return in_array($type, $this->accountTypes);
    }
}
