<?php

namespace spec\Quincalla\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Http\Request;

class CheckoutCustomerAuthSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('customer', 'john@example.com', 'password');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Jobs\CheckoutCustomerAuth');
    }

    function it_should_return_an_exception_when_invalid_checkout_type()
    {
        $this->beConstructedWith('invalid_type', 'email', 'password');
        $this->shouldThrow('Quincalla\Jobs\InvalidCheckoutTypeException')->duringHandle();
    }
}
