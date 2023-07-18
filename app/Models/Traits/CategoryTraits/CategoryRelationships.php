<?php

namespace App\Models\Traits\CategoryTraits;

use App\Models\Business;
use App\Models\CategoryInfo;
use App\Models\Product;

trait CategoryRelationships
{
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function category_infos()
    {
        return $this->hasMany(CategoryInfo::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
}
