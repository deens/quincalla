<?php

namespace Quincalla\Entities;

use Illuminate\Config\Repository;
use Illuminate\Session\Store;

class Checkout extends Repository
{
    protected $session;
    protected $sessionKey = 'checkout';
    protected $sessionItems;
    protected $defaults = [
        'checkout' => [
            'type' => 'customer',
        ],
        'account' => [
            'id' => 1,
            'name' => '',
            'email' => '',
            'register' => false,
        ],
        'shipping' => [
        ],
        'billing' => [
        ],
    ];

    public function __construct(Store $session)
    {
        $this->session = $session;

        if ($this->session->has($this->sessionKey)) {
            parent::__construct(
                $this->session->get($this->sessionKey)
            );
        } else {
            parent::__construct($this->defaults);
        }
    }

    public function store()
    {
        return $this->session->put($this->sessionKey, $this->all());
    }

    public function destroy()
    {
        return $this->session->forget($this->sessionKey);
    }
}
