<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'customer_email',
        'customer_name',
        'total_amount',
        'status',
        'card_name',
        'card_type',
        'card_number',
        'shipping_address',
        'billing_address',
        'comments',
        'shipped_at',
        'completed_at',
    ];

    public function items()
    {
        return $this->hasMany('Quincalla\Entities\OrderProduct');
    }
}
