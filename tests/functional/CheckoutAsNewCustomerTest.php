<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Quincalla\Tests\Functional\Helpers\ProductTrait;
use Quincalla\Tests\Functional\Helpers\CheckoutTrait;
use Quincalla\Tests\Functional\Helpers\CartTrait;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InvalidCheckoutAsNewCustomerTest extends TestCase
{
    use DatabaseTransactions;
    use ProductTrait;
    use CheckoutTrait;
    use CartTrait;

    public function test_it_should_checkout_a_new_customer()
    {
        $this->addProductToCart('first-necklace-yellow-gold');
        $this->continueToCheckout();
        $this->continueAsNewCustomer();
        $this->fillDeliveryWith([
            'name' => 'Johnny Curley',
            'address' => '1 First St.',
            'address1' => '',
            'city' => 'San Francisco',
            'state' => '1',
            'zipcode' => '94109',
            'phone' => '4152345678',
        ]);
        $this->fillPaymentAndContinue([
            'card_number' => '4242424242424242',
            'card_type' => '1',
            'ccv_code' => '123',
        ]);

        $this->seePageIs('/checkout/confirm');
    }
}
