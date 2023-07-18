<?php

namespace App\Models\Traits\SpotlightDailyTraits;

use App\Models\Business;
use App\Models\Product;
use App\Models\SpotlightDailyType;

trait SpotlightDailyRelationships
{
    public function products()
    {
        return $this->belongsToMany(Product::class, 'spotlight_products');
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function type()
    {
        return $this->belongsTo(SpotlightDailyType::class);
    }
}
