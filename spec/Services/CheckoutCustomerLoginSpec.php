<?php

namespace spec\Quincalla\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use Quincalla\Http\Controllers\CheckoutController as Listener;
use Quincalla\User;
// use Illuminate\Session\SessionManager;
// use Illuminate\Session\Store as Session;
use Illuminate\Validation\Factory as Validator;
use Illuminate\Validation\Validator as ValidatorInstance;
use Quincalla\Checkout;

class CheckoutCustomerLoginSpec extends ObjectBehavior
{
    function let(Checkout $checkout, Request $request, Guard $auth, Validator $validator)
    {
        $this->beConstructedWith($checkout, $request, $auth, $validator);
    }

    function it_should_redirect_back_with_message_when_account_type_empty(
        Listener $listener
    )
    {
        $listener->redirectBackWithMessage(Argument::type('string'))
            ->willReturn('redirect_with_message');

        $this->run($listener)->shouldBe('redirect_with_message');
    }

    function it_should_redirect_back_with_message_when_account_type_invalid(
        Request $request,
        Listener $listener
    )
    {
        $request->get('account_type')->willReturn('invalid_account_type');

        $listener->redirectBackWithMessage(Argument::type('string'))
            ->willReturn('redirect_with_message');

        $this->run($listener)->shouldBe('redirect_with_message');
    }

    function it_should_redirect_to_shipping_when_account_type_is_guest(
        Request $request,
        Checkout $checkout,
        Listener $listener
    )
    {
        $request->get('account_type')->willReturn('guest');

        $checkout->set(Argument::type('string'), Argument::type('string'))->shouldBeCalled();
        $checkout->get(Argument::type('string'))->shouldBeCalled();

        $listener->redirectToShipping()
            ->shouldBeCalled()
            ->willReturn('redirect_to_shipping');

        $this->run($listener)->shouldBe('redirect_to_shipping');
    }

    function it_should_redirect_back_with_validation_errors(
        Request $request,
        Checkout $checkout,
        Validator $validator,
        ValidatorInstance $validatorInstance,
        Listener $listener
    )
    {
        $request->get('account_type')->willReturn('customer');
        $request->get('email')->shouldBeCalled();
        $request->get('password')->shouldBeCalled();

        $checkout->set(Argument::type('string'), Argument::type('string'))->shouldBeCalled();
        $checkout->get(Argument::type('string'))->willReturn('customer');

        $validatorInstance->fails()->shouldBeCalled()->willReturn(true);
        $validator->make(Argument::type('array'), Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn($validatorInstance);

        $listener->redirectBackWithValidationErrors($validatorInstance)
            ->willReturn('redirect_with_validation_errors');

        $this->run($listener)->shouldBe('redirect_with_validation_errors');
    }

    function it_should_redirect_back_with_invalid_credentials(
        Request $request,
        Checkout $checkout,
        Validator $validator,
        ValidatorInstance $validatorInstance,
        Guard $auth,
        Listener $listener
    )
    {
        $request->get('account_type')->willReturn('customer');
        $request->get('email')->shouldBeCalled();
        $request->get('password')->shouldBeCalled();


        $checkout->set(Argument::type('string'), Argument::type('string'))->shouldBeCalled();
        $checkout->get(Argument::type('string'))->willReturn('customer');

        $validatorInstance->fails()->shouldBeCalled()->willReturn(false);
        $validator->make(Argument::type('array'), Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn($validatorInstance);

        $auth->attempt(Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn(false);

        $listener->redirectBackWithInvalidCredentials()
            ->shouldBeCalled()
            ->willReturn('redirect_with_invalid_credentials');

        $this->run($listener)->shouldBe('redirect_with_invalid_credentials');
    }

    function it_should_login_in_customer_with_valid_credentials_and_redirect_to_shipping(
        Request $request,
        Checkout $checkout,
        Validator $validator,
        ValidatorInstance $validatorInstance,
        Guard $auth,
        User $user,
        Listener $listener
    )
    {
        $request->get('account_type')->willReturn('customer');
        $request->get('email')->shouldBeCalled();
        $request->get('password')->shouldBeCalled();

        $checkout->set(Argument::type('string'), Argument::type('string'))->shouldBeCalled();
        $checkout->get(Argument::type('string'))->willReturn('customer');

        $validatorInstance->fails()->shouldBeCalled()->willReturn(false);
        $validator->make(Argument::type('array'), Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn($validatorInstance);

        $auth->attempt(Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn(true);
        $auth->user()->willReturn($user);

        $user->getAttribute('id')->willReturn(1);
        $user->getAttribute('email')->willReturn('user@example.com');

        $checkout->set('account.id', Argument::type('integer'))->shouldBeCalled();
        $checkout->set('account.email', Argument::type('string'))->shouldBeCalled();

        $listener->redirectToShipping()
            ->shouldBeCalled()
            ->willReturn('redirect_to_shipping');

        $this->run($listener)->shouldBe('redirect_to_shipping');
    }
}
