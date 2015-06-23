<?php

namespace spec\Quincalla\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckoutStoreShippingSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Services\CheckoutStoreShipping');
    }
}
