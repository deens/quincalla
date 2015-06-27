<?php
namespace spec\Quincalla\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Quincalla\Checkout;
use Quincalla\Http\Requests\Request;
use Illuminate\Validation\Factory as Validator;
use Illuminate\Validation\Validator as ValidatorInstance;
use Quincalla\Http\Controllers\CheckoutController as Listener;


class CheckoutStoreShippingSpec extends ObjectBehavior
{
    function let(Request $request, Checkout $checkout, Validator $validator)
    {
        $this->beConstructedWith($request, $checkout, $validator);
    }

    function it_should_redirect_back_with_validation_errors(
        Request $request,
        Checkout $checkout,
        Listener $listener,
        Validator $validator,
        ValidatorInstance $validatorInstance
    )
    {
        $checkout->get('checkout.type')->willReturn('guest');

        $request->all()->shouldBeCalled()->willReturn([]);

        $validator->make(Argument::type('array'), Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn($validatorInstance);

        $validatorInstance->fails()
            ->shouldBeCalled()
            ->willReturn(true);

        $listener->redirectBackWithValidationErrors($validatorInstance)
            ->shouldBeCalled()
            ->willReturn('redirect_validation_error');

        $this->run($listener)->shouldBe('redirect_validation_error');
    }
}
