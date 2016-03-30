<?php

namespace spec\Quincalla\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Http\Request;
use Quincalla\Entities\Checkout;
use Illuminate\Auth\Guard;
use Quincalla\Entities\User;

class CheckoutCustomerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('john@example.com', 'password');
    }

    function it_should_throw_exception_when_provide_invalid_credentials(Guard $auth, Checkout $checkout)
    {
        $auth->attempt(Argument::type('array'))->shouldBeCalled()->willReturn(false);

        $this->beConstructedWith('invalid@example.com', 'password');
        $this->shouldThrow(new \Exception('Invalid credentials'))->during('handle', [$auth, $checkout]);
    }

    function it_should_set_checkout_session_with_customer_information(Guard $auth, Checkout $checkout, User $user)
    {
        $auth->attempt(Argument::type('array'))->shouldBeCalled()->willReturn(true);
        $auth->user()->shouldBeCalled()->willReturn($user);
        $checkout->set(Argument::any(), Argument::any())->shouldBeCalledTimes(3);
        $checkout->store()->shouldBeCalled();

        $this->beConstructedWith('valid@example.com', 'password');
        $this->handle($auth, $checkout);
    }
}
