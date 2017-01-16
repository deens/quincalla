<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckoutAsNewCustomerTest extends TestCase
{
    use CheckoutTrait;
    use DatabaseMigrations;

    /** @test */
    public function blindly_follow_the_steps_of_checkout_as_new_customer()
    {
        $name = 'John Doe';
        $email = 'john@example.com';
        $pass = 'secret';

        $state = factory(Quincalla\Entities\State::class)->create();
        $product = factory(Quincalla\Entities\Product::class)->create([
            'slug' => 'first-product',
        ]);

        $this->visit('/products/'.$product->slug)
            ->press('Add To Cart')
            ->see('Product has been added to your cart')

            // Product added to cart and checkout.
            ->visit('/cart')
            ->see($product->name)
            ->click('Checkout')

            // Continue as new customer.
            ->seePageIs('/order/customer')
            ->click('Continue as New Customer')

            // Register a new customer.
            ->seePageIs('/order/register')
            ->type($name, 'name')
            ->type($email, 'email')
            ->type($pass, 'password')
            ->type($pass, 'password_confirmation')
            ->press('Continue to Delivery');

        $this->fillDeliveryWith([
            'name'     => $name,
            'address'  => '1 First St.',
            'address1' => '',
            'city'     => 'San Francisco',
            'state'    => 1,
            'country'  => 1,
            'zipcode'  => '94109',
            'phone'    => '4152345678',
        ]);

        $this->fillPaymentWith([
            'card_number' => '4242424242424242',
            'exp_month'   => '11',
            'exp_year'    => '2018',
            'cvc'         => '123',
        ]);

        $this->seePageIs('/order/confirm');
    }
}
