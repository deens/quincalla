<?php

namespace spec\Quincalla\Entities;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OrderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Entities\Order');
    }
}
