<?php

namespace App\Models\Traits\UserTraits;

use App\Models\Business;
use App\Models\Cart;
use App\Models\Order;

trait UserRelationships
{
    public function business()
    {
        return $this->hasOne(Business::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
