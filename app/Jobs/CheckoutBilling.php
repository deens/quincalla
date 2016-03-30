<?php

namespace Quincalla\Jobs;

use Quincalla\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Quincalla\Entities\Address;
use Quincalla\Entities\Checkout;

class CheckoutBilling extends Job implements SelfHandling
{
    public $request;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Address $address, Checkout $checkout)
    {
        //
    }
}
