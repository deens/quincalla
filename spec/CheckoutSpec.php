<?php

namespace spec\Quincalla;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Session\SessionManager;

class CheckoutSpec extends ObjectBehavior
{
    function let(Store $session)
    {
        $this->beConstructedWith($session);
    }

    function it_should_assign_default_session_when_checkout_start(
        Store $session
    )
    {
        $session->has(Argument::type('string'))->willReturn(false);

        $this->get('checkout.type')->shouldBeLike('customer');
    }

    function it_should_populate_checkout_with_existing_session(Store $session)
    {
        $session->has(Argument::type('string'))->willReturn(true);
        $session->get(Argument::exact('checkout'))
            ->shouldBeCalled()
            ->willReturn(['property' => ['value' => 'working']]);

        $this->get('property.value')->shouldBeLike('working');
    }

    function it_should_store_checkout_session_for_next_request(Store $session)
    {
        $sessionData = ['property' => ['value' => 'working']];
        $sessionExpectedData = ['property' => ['value' => 'working', 'newvalue' => 'progress']];


        $session->has(Argument::type('string'))->willReturn(true);
        $session->get(Argument::exact('checkout'))
            ->shouldBeCalled()
            ->willReturn($sessionData);

        $this->set('property.newvalue', 'progress');

        $session->put(Argument::type('string'), $sessionExpectedData)
            ->shouldBeCalled()
            ->willReturn('updated_session_saved');

        $this->all()->shouldBeLike($sessionExpectedData);

        $this->store()->shouldBe('updated_session_saved');
    }

    function it_should_destroy_session(Store $session)
    {
        $session->has(Argument::type('string'))->shouldBeCalled();
        $session->forget(Argument::type('string'))
            ->shouldBeCalled()
            ->willReturn('checkout_destroyed');

        $this->destroy()->shouldBe('checkout_destroyed');
    }

}
