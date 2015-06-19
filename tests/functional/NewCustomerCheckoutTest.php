<?php

namespace Quincalla\Tests\Functional;

use Quincalla\Tests\TestCase;
use Quincalla\Tests\Functional\Helpers\ProductTrait;
use Quincalla\Tests\Functional\Helpers\CheckoutTrait;
use Quincalla\Tests\Functional\Helpers\CartTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewCustomerCheckoutTest extends TestCase
{
    use DatabaseTransactions;
    use ProductTrait;
    use CheckoutTrait;
    use CartTrait;

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
