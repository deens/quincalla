<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Quincalla\Tests\Functional\Helpers\ProductTrait;
use Quincalla\Tests\Functional\Helpers\CheckoutTrait;
use Quincalla\Tests\Functional\Helpers\CartTrait;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckoutAsNewCustomerTest extends TestCase
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
        $this->fillShippingAddressWith([
            'first_name' => 'Johnny',
            'last_name' => 'Curley',
            'address' => '1 First St.',
            'address1' => '',
            'city' => 'San Francisco',
            'state' => '1',
            'zipcode' => '94109',
            'phone' => '4152345678',
        ], 'johnnyc@example.com', 'password', 'password');
        $this->fillPaymentAndContinue([
            'name_on_card' => 'Johnny',
            'card_number' => '4242424242424242',
            'card_type' => '1',
            'ccv_code' => '123',
        ]);

        $this->seePageIs('/checkout/confirm');
    }

    public function test_it_should_fail_checkout_when_password_does_not_match()
    {
        $this->addProductToCart('first-necklace-yellow-gold');
        $this->continueToCheckout();
        $this->continueAsNewCustomer();
        $this->fillShippingAddressWith([
            'first_name' => 'Johnny',
            'last_name' => 'Curley',
            'address' => '1 First St.',
            'address1' => '',
            'city' => 'San Francisco',
            'state' => '1',
            'zipcode' => '94109',
            'phone' => '4152345678',
        ], 'johnnyc@example.com', 'password', 'not_matching_password');

        $this->see('The password confirmation does not match.');
    }
}
