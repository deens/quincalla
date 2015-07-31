<?php

namespace Quincalla\Jobs;

use Quincalla\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Quincalla\Entities\Checkout;

class InvalidCheckoutTypeException extends \Exception {}
class CheckoutCustomerAuth extends Job implements SelfHandling
{
    protected $type;
    protected $email;
    protected $password;

    /**
     * Types of customers
     */
    protected $checkoutTypes = [
        'guest',
        'customer',
        'new_customer'
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($type, $email, $password)
    {
        $this->type = $type;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        var_dump($this->type);
        if ( ! $this->validType()) {
            throw new InvalidCheckoutTypeException();
        }
        return [];
    }

    /**
     * Verify if checkout account type is valid.
     *
     * @return boolen
     */
    private function validType()
    {
        return in_array($this->type, $this->checkoutTypes);
    }
}
