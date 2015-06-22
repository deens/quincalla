<?php

namespace spec\Quincalla\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Http\Request;
use Illuminate\Validation\Factory as Validator;
use Illuminate\Validation\Validator as ValidatorInstance;
use Illuminate\Auth\Guard;
use Quincalla\Http\Controllers\CheckoutController as Listener;
use Quincalla\User;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store as Session;

class CheckoutCustomerLoginSpec extends ObjectBehavior
{
    function let(Request $request, Guard $auth, Validator $validator)
    {
        $this->beConstructedWith($request, $auth, $validator);
    }

    function it_should_return_an_exception_when_listener_missing()
    {

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
        Session $session,
        Listener $listener
    )
    {
        $request->get('account_type')->willReturn('guest');

        $request->session()->willReturn($session);

        $session->put(Argument::type('string'), Argument::type('array'))
            ->shouldBeCalled();

        $listener->redirectToShipping()
            ->shouldBeCalled()
            ->willReturn('redirect_to_shipping');

        $this->run($listener)->shouldBe('redirect_to_shipping');
    }

    function it_should_redirect_back_with_validation_errors(
        Request $request,
        Validator $validator,
        ValidatorInstance $validatorInstance,
        Listener $listener
    )
    {
        $request->get('account_type')->willReturn('customer');
        $request->get('email')->shouldBeCalled();
        $request->get('password')->shouldBeCalled();

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
        Validator $validator,
        ValidatorInstance $validatorInstance,
        Guard $auth,
        Listener $listener
    )
    {
        $request->get('account_type')->willReturn('customer');
        $request->get('email')->shouldBeCalled();
        $request->get('password')->shouldBeCalled();

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
        Validator $validator,
        ValidatorInstance $validatorInstance,
        Guard $auth,
        User $user,
        Session $session,
        Listener $listener
    )
    {
        $request->get('account_type')->willReturn('customer');
        $request->get('email')->shouldBeCalled();
        $request->get('password')->shouldBeCalled();

        $validatorInstance->fails()->shouldBeCalled()->willReturn(false);
        $validator->make(Argument::type('array'), Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn($validatorInstance);

        $auth->attempt(Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn(true);
        $auth->user()->willReturn($user);

        $user->getAttribute('id')->willReturn(Argument::type('integer'));
        $user->getAttribute('email')->willReturn(Argument::type('string'));

        $request->session()->shouldBeCalled()
            ->willReturn($session);

        $session->put(Argument::type('string'), Argument::type('array'))
            ->shouldBeCalled();

        $listener->redirectToShipping()
            ->shouldBeCalled()
            ->willReturn('redirect_to_shipping');

        $this->run($listener)->shouldBe('redirect_to_shipping');
    }
}
