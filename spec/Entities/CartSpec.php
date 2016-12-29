<?php

namespace spec\Quincalla\Entities;

use PhpSpec\Laravel\LaravelObjectBehavior;

class CartSpec extends LaravelObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Entities\Cart');
    }
}
