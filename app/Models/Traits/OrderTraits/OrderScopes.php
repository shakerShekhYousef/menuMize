<?php

namespace App\Models\Traits\OrderTraits;

trait OrderScopes
{
    public function scopeStatus($query, $order_status_id)
    {
        $query->where('order_status_id', $order_status_id);
    }
}
