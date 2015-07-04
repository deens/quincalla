<?php
namespace spec\Quincalla\Services;

use Illuminate\Validation\Factory as Validator;
use Illuminate\Validation\Validator as ValidatorInstance;
use Quincalla\Entities\Checkout;
use Quincalla\Entities\Order;
use Quincalla\Entities\User;
use Quincalla\Http\Controllers\CheckoutController as Listener;
use Quincalla\Http\Requests\Request;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Quincalla\Entities\Cart;


class CheckoutStoreBillingSpec extends ObjectBehavior
{
    function let(
        Request $request,
        Checkout $checkout,
        Validator $validator,
        Order $orders,
        User $users,
        Cart $cart
    ) {
        $this->beConstructedWith($request, $checkout, $validator, $orders, $users, $cart);
    }

    function it_should_redirect_back_with_validation_errors(
        Request $request,
        Checkout $checkout,
        Listener $listener,
        Validator $validator,
        ValidatorInstance $validatorInstance
    ) {
        $request->get(Argument::exact('same_address'))->willReturn(true);
        $request->all()->shouldBeCalled()->willReturn([]);

        $validator->make(Argument::type('array'), Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn($validatorInstance);
        $validatorInstance->fails()->shouldBeCalled()->willReturn(true);

        $checkout->set(Argument::exact('billing.same_address'), Argument::type('bool'))
            ->shouldBeCalled();
        $checkout->store()->shouldBeCalled();

        $listener->redirectBackWithValidationErrors($validatorInstance)
            ->shouldBeCalled()
            ->willReturn('redirect_back_with_validation_errors');
        $this->run($listener)->shouldBe('redirect_back_with_validation_errors');
    }

    function it_should_use_same_shipping_address_as_billing(
        Request $request,
        Checkout $checkout,
        Listener $listener,
        Validator $validator,
        ValidatorInstance $validatorInstance,
        User $users,
        Order $orders,
        Cart $cart
    ) {
        $request->get(Argument::exact('same_address'))->willReturn(true);
        $request->all()->shouldBeCalled()->willReturn([]);
        $request->get(Argument::type('string'))->shouldBeCalledTimes(9);

        $validator->make(Argument::type('array'), Argument::type('array'))
            ->shouldBeCalled()
            ->willReturn($validatorInstance);
        $validatorInstance->fails()->shouldBeCalled()->willReturn(false);

        $checkout->set(Argument::exact('billing.same_address'), Argument::type('bool'))
            ->shouldBeCalled();
        $checkout->get(Argument::exact('shipping'))
            ->shouldBeCalled()
            ->willReturn([
                'first_name' => 'john',
                'last_name' => 'doe'
            ]);
        $checkout->get(Argument::exact('checkout.type'))->shouldBeCalled()->willReturn('guest');
        $checkout->get(Argument::exact('account.name'))->shouldBeCalled()->willReturn('john doe');
        $checkout->get(Argument::exact('account.email'))->shouldBeCalled();
        $checkout->get(Argument::exact('payment.name_on_card'))->shouldBeCalled();
        $checkout->get(Argument::exact('payment.card_type'))->shouldBeCalled();
        $checkout->get(Argument::exact('payment.card_number'))->shouldBeCalled()->willReturn('4242424242424242');
        $checkout->get(Argument::exact('shipping'))->shouldBeCalled();
        $checkout->get(Argument::exact('billing'))->shouldBeCalled();
        $checkout->set(Argument::exact('account.name'), Argument::type('string'))->shouldBeCalled();
        $checkout->set(Argument::type('string'), Argument::type('array'))->shouldBeCalledTimes(2);
        $checkout->set(Argument::type('string'), Argument::type('bool'))->shouldBeCalled();
        $checkout->store()->shouldBeCalled();

        $users->newInstance()->shouldBeCalled()
            ->willReturn($users);
        $users->setAttribute(Argument::type('string'), Argument::any())->shouldBeCalledTimes(5);
        $users->save()->shouldBeCalled();

        $orders->newInstance()->shouldBeCalled()
            ->willReturn($orders);
        $orders->setAttribute(Argument::type('string'), Argument::any())->shouldBeCalledTimes(9);
        $orders->save()->shouldBeCalled();

        $cart->total()->shouldBeCalled();
        $cart->content()->shouldBeCalled()->willReturn([]);
        $cart->destroy()->shouldBeCalled();

        $this->run($listener);
    }
}
