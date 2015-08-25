<?php

namespace spec\Quincalla\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Http\Request;

class CheckoutShippingSpec extends ObjectBehavior
{
    function let(Request $request)
    {
        $this->beConstructedWith($request);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Jobs\CheckoutShipping');
    }
}
