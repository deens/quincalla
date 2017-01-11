<?php

namespace Quincalla\Entities;

use Illuminate\Config\Repository;
use Illuminate\Session\SessionManager;

class Checkout extends Repository
{
    protected $session;
    protected $sessionKey = 'checkout';
    protected $items = [
        'checkout' => ['type' => 'customer'],
        'account' => ['id' => 1, 'name' => '', 'email' => ''],
        'shipping' => [],
        'billing' => [],
        'payment' => []
    ];

    public function __construct(SessionManager $session)
    {
        $this->session = $session;

        if ($this->session->has($this->sessionKey)) {
            parent::__construct($this->session->get($this->sessionKey));
        } else {
            parent::__construct($this->items);
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
