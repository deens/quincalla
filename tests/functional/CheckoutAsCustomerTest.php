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
        $this->addProductToCart('first-necklace-yellow-gold');
        $this->continueToCheckout();
        $this->continueAsCustomer('john@example.com', 'password');

        $this->fillShippingAddressWith([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '1 First St.',
            'address1' => '',
            'city' => 'San Francisco',
            'state' => '1',
            'zipcode' => '94109',
            'phone' => '4152345678',
        ]);

        $this->fillPaymentAndContinue([
            'name_on_card' => 'Johnny',
            'card_number' => '4242424242424242',
            'card_type' => '1',
            'ccv_code' => '123',
        ]);

        $this->seePageIs('/checkout/confirm');
    }
}
