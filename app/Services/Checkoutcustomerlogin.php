<?php

namespace Quincalla\Services;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use Illuminate\Validation\Factory as Validator;
use Quincalla\Checkout;

class CheckoutCustomerLogin
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
            'new-customer'
    ];

    public function __construct(Checkout $checkout, Request $request, Guard $auth, Validator $validator)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->auth = $auth;
        $this->checkout = $checkout;
    }

    public function run($listener)
    {
        $this->listener = $listener;

        if (! $this->validAccountType($this->request->get('account_type'))) {
            return $this->listener->redirectBackWithMessage('Invalid Account Type Selected');
        }

        $this->checkout->set('checkout.type', $this->request->get('account_type'));

        if ($this->checkout->get('checkout.type') === 'customer') {
            return $this->loginCustomer();
        }

        return $this->listener->redirectToShipping();
    }

    public function loginCustomer()
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $this->credentials = [
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password')
        ];

        $validator = $this->validator->make($this->credentials, $rules);

        if ($validator->fails()) {
            return $this->listener->redirectBackWithValidationErrors($validator);
        }

        $loggedIn = $this->auth->attempt($this->credentials + ['active' => true]);

        if (!$loggedIn) {
            return $this->listener->redirectBackWithInvalidCredentials();
        }

        $this->checkout->set('account.id', $this->auth->user()->id);
        $this->checkout->set('account.email', $this->auth->user()->email) ;

        return $this->listener->redirectToShipping();
    }

    private function validAccountType($type)
    {
        if (! in_array($type, $this->accountTypes)) {
            return false;
        }
        return true;
    }
}
