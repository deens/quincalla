<?php

namespace Quincalla\Services;

use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use Illuminate\Validation\Factory as Validator;

class CheckoutCustomerLogin
{

    protected $request;
    protected $validator;
    protected $auth;
    protected $listener;
    protected $checkout = [
        'checkout' => [
            'type' => 'customer',
        ],
        'account' => [
            'id' => 0,
            'email' => '',
            'name' => '',
            'register' => false
        ]
    ];

    protected $credentials = [];

    public function __construct(Request $request, Guard $auth, Validator $validator)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->auth = $auth;
    }

    public function run($listener)
    {
        $this->listener = $listener;

        if (! $this->request->get('account_type')) {
            return $this->listener->redirectBackWithMessage('Invalid Account Type Selected');
        }

        $this->checkout['checkout']['type'] = $this->request->get('account_type');

        if ($this->checkout['checkout']['type'] === 'customer') {
            return $this->loginExistingCustomer();
        }

        if (!$this->isNewCustomerAccount()) {
            return $this->listener->redirectBackWithMessage('Invalid Account Type Selected');
        }

        $this->request->session()->put('checkout', $this->checkout);

        return $this->listener->redirectToShipping();
    }

    public function isNewCustomerAccount()
    {
        return $this->checkout['checkout']['type'] === 'guest' 
            || $this->checkout['checkout']['type'] === 'new-customer';
    }

    public function loginExistingCustomer()
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

        $this->checkout['account']['id'] = $this->auth->user()->id;
        $this->checkout['account']['email'] = $this->auth->user()->email;

        $this->request->session()->put('checkout', $this->checkout);

        return $this->listener->redirectToShipping();
    }
}
