<?php

namespace App\Models\Traits\CartTraits;

use App\Models\Product;

trait CartRelationships
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_carts');
    }
}
