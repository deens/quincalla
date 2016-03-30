<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Quincalla\Tests\Functional\Helpers\CartTrait;
use Quincalla\Tests\Functional\Helpers\ProductTrait;
use Quincalla\Tests\Functional\Helpers\CheckoutTrait;

class CheckoutAsCustomerTest extends TestCase
{
    use CartTrait;
    use ProductTrait;
    use CheckoutTrait;

    public function test_it_should_checkout_an_existing_customer()
    {
        $this->addProductToCart('first-necklace-yellow-gold')
            ->continueToCheckout()
            ->continueAsCustomer('john@example.com', 'password')
            ->fillDeliveryWith([
                'name' => 'John Doe',
                'address' => '1 First St.',
                'address1' => '',
                'city' => 'San Francisco',
                'state' => '1',
                'zipcode' => '94109',
                'phone' => '4152345678',
            ])
            ->fillPaymentWith([
                'card_number' => '4242424242424242',
                'exp_month' => '1',
                'exp_year' => '2018',
                'cvc' => '123',
            ])
            ->seePageIs('/order/confirm');
    }
}
