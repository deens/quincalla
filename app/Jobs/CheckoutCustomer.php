<?php

namespace Quincalla\Jobs;

use Quincalla\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Quincalla\Entities\Checkout;
use Illuminate\Auth\Guard;

class CheckoutCustomer extends Job implements SelfHandling
{
    protected $email;
    protected $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Guard $auth, Checkout $checkout)
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
            'active' => true
        ];

        $customer = $auth->attempt($credentials);

        if (!$customer) {
            throw new \Exception('Invalid credentials');
        }

        $checkout->set('checkout.type', 'customer');
        $checkout->set('account.id', $auth->user()->id);
        $checkout->set('account.email', $auth->user()->email);
        $checkout->store();
    }
}
