<?php

namespace App\Models\Traits\OrderTraits;

use App\Models\Cart;
use App\Models\OrderStatus;

trait OrderRelationships
{
    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
