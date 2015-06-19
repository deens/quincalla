<?php

namespace  Quincalla\Tests\Functional\Helpers;

trait CartTrait
{
    public function continueToCheckout()
    {
        $this->seePageIs('/cart')
            ->click('Continue to checkout');
    }
}
