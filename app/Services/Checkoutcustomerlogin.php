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

    public function __construct(Request $request, Guard $auth, Validator $validator, $listener)
    {
        $this->request = $request;
        $this->validator = $validator;
        $this->auth = $auth;
        $this->listener = $listener;
    }

    public function run()
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $credentials = [
            'email' => $this->request->get('email'),
            'password' => $this->request->get('password')
        ];

        $validator = $this->validator->make($credentials, $rules);

        if ($validator->fails()) {
            return $this->listener->redirectBackWithErrors($validator->errors());
        }

        $loggedIn =  $this->auth->attempt($credentials + ['active' => true]);

        if (!$loggedIn) {
            return $this->listener->redirectBackWithInvalidCredentials();
        }

        return $loggedIn;
    }
}
