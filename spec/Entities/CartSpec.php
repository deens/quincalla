<?php

namespace spec\Quincalla\Entities;

use PhpSpec\Laravel\LaravelObjectBehavior;
use Prophecy\Argument;

class CartSpec extends LaravelObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Entities\Cart');
    }
}
