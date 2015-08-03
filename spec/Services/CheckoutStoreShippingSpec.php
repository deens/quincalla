<?php

namespace spec\Quincalla\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Quincalla\Entities\Checkout;
use Quincalla\Http\Requests\Request;
use Quincalla\Http\Controllers\CheckoutController as Listener;
use Illuminate\Contracts\Hashing\Hasher;

class CheckoutStoreShippingSpec extends ObjectBehavior
{
    function let(Request $request, Checkout $checkout, Hasher $hash)
    {
        $this->beConstructedWith($request, $checkout, $hash);
    }

    function it_should_redirect_to_billing_and_store_shipping_in_checkout_session(
        Request $request,
        Checkout $checkout,
        Hasher $hash,
        Listener $listener
    )
    {
        $request->merge(Argument::type('array'))->shouldBeCalled();
        $request->except('password', 'password_confirmation')->shouldBeCalled()->willReturn([]);
        $request->get(Argument::type('string'), Argument::any())->shouldBeCalledTimes(11)->willReturn('');
        $hash->make(Argument::type('string'))->shouldBeCalled()->willReturn('text');
        $checkout->get('checkout.type')->willReturn('new-customer');
        $checkout->set(Argument::type('string'), Argument::any())->shouldBeCalledTimes(3);
        $checkout->store()->shouldBeCalled();
        $listener->redirectToBilling()->shouldBeCalled()->willReturn('redirect_to_shipping');

        $this->run($listener)->shouldBe('redirect_to_shipping');
    }
}
