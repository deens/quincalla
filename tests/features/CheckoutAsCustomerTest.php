<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckoutAsCustomerTest extends TestCase
{
    use CheckoutTrait;
    use DatabaseMigrations;

    /** @test */
    public function blindly_follow_the_steps_of_checkout_as_returning_customer()
    {
        $password = 'secret';

        $state = factory(Quincalla\Entities\State::class)->create();
        $user = factory(Quincalla\Entities\User::class)->create();
        $product = factory(Quincalla\Entities\Product::class)->create([
            'slug' => 'first-product',
        ]);

        // Product page
        $this->visit('/products/'.$product->slug)
            ->press('Add To Cart')
            ->see('Product has been added to your cart')

            // Product added to cart and checkout.
            ->visit('/cart')
            ->see($product->name)
            ->click('Continue to checkout')

            // Start checkout as existing customer.
            ->seePageIs('/order/customer')
            ->type($user->email, 'email')
            ->type($password, 'password')
            ->press('Sign in to checkout')

            // Start checkout delivery address.
            ->fillDeliveryWith([
                'name'     => 'John Doe',
                'address'  => '1 First St.',
                'address1' => '',
                'city'     => 'San Francisco',
                'state'    => $state->id, // California
                'country'  => $state->country_id, // US
                'zipcode'  => '94109',
                'phone'    => '4152345678',
            ])

            // Start checkout billing address
            ->fillPaymentWith([
                'card_number' => '4242424242424242',
                'exp_month'   => '1',
                'exp_year'    => '2018',
                'cvc'         => '123',
            ])
            ->seePageIs('/order/confirm');
    }
}
