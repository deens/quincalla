<?php

namespace  Quincalla\tests\Functional\Helpers;

trait CartTrait
{
    public function continueToCheckout()
    {
        return $this->visit('/cart')
            ->click('Continue to checkout');
    }
}
