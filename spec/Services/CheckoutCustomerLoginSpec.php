<?php

namespace spec\Quincalla\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as Validator;
use Illuminate\Validation\Validator as ValidatorInstance;
use Illuminate\Auth\Guard;
use Quincalla\Http\Controllers\CheckoutController;

class CheckoutCustomerLoginSpec extends ObjectBehavior
{
    function let(Request $request, Guard $auth, Validator $validator, CheckoutController $listener)
    {
        $this->beConstructedWith($request, $auth, $validator, $listener);
    }

    function it_should_login_in_customer_with_valid_credentials(
        Request $request,
        Validator $validator,
        ValidatorInstance $validatorInstance,
        Guard $auth
    )
    {
        $email = 'john@example.com';
        $password = 'password';

        $request->get('email')->willReturn($email);
        $request->get('password')->willReturn($password);

        $validatorInstance->fails()->shouldBeCalled()->willReturn(false);

        $validator->make(
            ['email' => $email, 'password' => $password],
            ['email' => 'required', 'password' => 'required']
        )->willReturn($validatorInstance);

        $auth->attempt(
            [
                'email' => $email,
                'password' => $password,
                'active' => true
            ]
        )->willReturn(true);

        $this->run()->shouldBe(true);
    }

}
