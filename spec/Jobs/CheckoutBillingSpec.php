<?php

namespace spec\Quincalla\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckoutBillingSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Jobs\CheckoutBilling');
    }
}
