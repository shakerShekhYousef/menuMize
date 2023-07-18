<?php

namespace App\Models\Traits\ProductTraits;

use App\Models\Business;
use App\Models\Cart;
use App\Models\ProductInfo;
use App\Models\ProductIngredient;

trait ProductRelationships
{
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function product_infos()
    {
        return $this->hasMany(ProductInfo::class);
    }

    public function product_ingredients()
    {
        return $this->hasMany(ProductIngredient::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'product_carts');
    }
}
