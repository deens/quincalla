<?php

use Illuminate\Session\Store;
use Quincalla\Entities\Checkout;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CheckoutTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->checkout = new Checkout(app('session'));
    }

    /** @test */
    public function it_should_be_instance()
    {
        $this->assertInstanceOf(Quincalla\Entities\Checkout::class, $this->checkout);
    }

    /** @test */
    public function it_should_contain_checkout_basic_structure()
    {
        $this->assertTrue($this->checkout->has('account'));
        $this->assertTrue($this->checkout->has('shipping'));
        $this->assertTrue($this->checkout->has('billing'));
        $this->assertTrue($this->checkout->has('payment'));
    }

    /** @test */
    function it_should_return_boolean_if_exist_with_dot_notation()
    {
        $this->assertTrue($this->checkout->has('checkout.type'));
    }

    /** @test */
    public function it_should_return_value_with_dot_notation()
    {
        $this->assertEquals($this->checkout->get('checkout.type'), 'customer');
    }


}
