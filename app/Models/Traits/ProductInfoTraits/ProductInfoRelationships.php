<?php

namespace App\Models\Traits\ProductInfoTraits;

use App\Models\Product;

trait ProductInfoRelationships
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
