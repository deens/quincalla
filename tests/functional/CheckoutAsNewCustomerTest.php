<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Quincalla\Tests\Functional\Helpers\ProductTrait;
use Quincalla\Tests\Functional\Helpers\CheckoutTrait;
use Quincalla\Tests\Functional\Helpers\CartTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckoutAsNewCustomer extends TestCase
{
    use DatabaseTransactions;
    use ProductTrait;
    use CheckoutTrait;
    use CartTrait;

    public function testCheckoutAsNewCustomer()
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
            'phone' => '4152345678'
        ], 'johnnyc@example.com', 'password', 'password');
        $this->fillPaymentAndContinue([
            'name_on_card' => 'Johnny',
            'card_number' => '4242424242424242',
            'card_type' => '1',
            'ccv_code' => '123'
        ]);

        $this->seePageIs('/checkout/confirm');
    }

    public function testCheckoutAsNewCustomerWithInvalidPassword()
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
            'phone' => '4152345678'
        ], 'johnnyc@example.com', 'password', 'not_matching_password');

        $this->see('The password confirmation does not match.');
    }
}
