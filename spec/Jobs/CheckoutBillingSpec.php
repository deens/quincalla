<?php

namespace spec\Quincalla\Jobs;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Illuminate\Http\Request;

class CheckoutBillingSpec extends ObjectBehavior
{
    function let(Request $request)
    {
        $this->beConstructedWith($request);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Jobs\CheckoutBilling');
    }
}
