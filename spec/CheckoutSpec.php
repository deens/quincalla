<?php

namespace spec\Quincalla;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CheckoutSpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType('Quincalla\Checkout');
    }

    function it_should_return_eliurkis()
    {
        $this->get('account.email')->shouldBe("eliurkis@gmail.com");
    }

    function it_should_overwrite_email()
    {
        $email = 'mojito@example.com';

        $this->get('account.email')->shouldBe("eliurkis@gmail.com");

        $this->set('account.email', $email);

        $this->get('account.email')->shouldBe($email);
    }
}
