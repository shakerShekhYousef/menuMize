<?php

namespace App\Models\Traits\OrderStatusTraits;

use App\Models\OrderStatus;

trait OrderStatusRelationships
{
    public function orders()
    {
        return $this->hasMany(OrderStatus::class);
    }
}
