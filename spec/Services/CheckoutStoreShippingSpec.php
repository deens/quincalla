<?php
namespace spec\Quincalla\Services;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Quincalla\Entities\Checkout;
use Quincalla\Http\Requests\Request;
use Illuminate\Validation\Factory as Validator;
use Illuminate\Validation\Validator as ValidatorInstance;
use Quincalla\Http\Controllers\CheckoutController as Listener;
use Illuminate\Contracts\Hashing\Hasher;


class CheckoutStoreShippingSpec extends ObjectBehavior
{
    function let(Request $request, Checkout $checkout, Validator $validator, Hasher $hash)
    {
        $this->beConstructedWith($request, $checkout, $validator, $hash);
    }

    function it_should_redirect_back_with_validation_errors(
        Request $request,
        Checkout $checkout,
        Listener $listener,
        Validator $validator,
        ValidatorInstance $validatorInstance
   )
    {
        $request->merge(Argument::type('array'))
            ->shouldBeCalled();

        $request->except('password', 'password_confirmation')
            ->shouldBeCalled()
            ->willReturn([]);
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

    function it_should_redirect_to_billing_and_store_shipping_in_checkout_session(
        Request $request,
        Checkout $checkout,
        Validator $validator,
        ValidatorInstance $validatorInstance,
        Hasher $hash,
        Listener $listener
    )
    {
        $request->merge(Argument::type('array'))
            ->shouldBeCalled();

        $request->except('password', 'password_confirmation')
            ->shouldBeCalled()
            ->willReturn([]);

        $checkout->get('checkout.type')->willReturn('new-customer');

        $request->all()->shouldBeCalled()->willReturn([]);

        $validator->make(Argument::type('array'), Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn($validatorInstance);
        $validatorInstance->fails()
            ->shouldBeCalled()
            ->willReturn(false);

        $request->get(Argument::exact('account_email'), Argument::type('string'))
            ->shouldBeCalled()
            ->willReturn('user@example.com');
        $request->get(Argument::exact('password'), Argument::type('string'))
            ->shouldBeCalled()
            ->willReturn('password');
        $request->get(Argument::type('string'))
            ->willReturn('');

        $hash->make(Argument::type('string'))->shouldBeCalled()->willReturn('text');

        $checkout->set(Argument::exact('account.email'), Argument::type('string'))
            ->shouldBeCalled();
        $checkout->set(Argument::exact('account.password'), Argument::type('string'))
            ->shouldBeCalled();

        $checkout->set(Argument::exact('shipping'), Argument::type('array'))->shouldBeCalled();

        $checkout->store()->shouldBeCalled();

        $listener->redirectToBilling()
            ->shouldBeCalled()
            ->willReturn('redirect_to_shipping');

        $this->run($listener)
            ->shouldBe('redirect_to_shipping');
    }
}
