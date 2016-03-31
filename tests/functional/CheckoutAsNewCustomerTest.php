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
        $name = 'Johnny Curley';
        $email = 'johnny@example.com';
        $pass = 'password';

        $this->addProductToCart('first-necklace-yellow-gold');
        $this->continueToCheckout();
        $this->continueAsNewCustomer();
        $this->fillRegisterCustomerWith($name, $email, $pass, $pass);
        $this->fillDeliveryWith([
            'name' => $name,
            'address' => '1 First St.',
            'address1' => '',
            'city' => 'San Francisco',
            'state' => '1',
            'zipcode' => '94109',
            'phone' => '4152345678',
        ]);
        $this->fillPaymentWith([
            'card_number' => '4242424242424242',
            'exp_month' => '11',
            'exp_year' => '2016',
            'cvc' => '123',
        ]);

        $this->seePageIs('/order/confirm');
    }
}
