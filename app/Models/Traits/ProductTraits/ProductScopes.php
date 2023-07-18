<?php

namespace App\Models\Traits\ProductTraits;

trait ProductScopes
{
    public function scopeRelations($query)
    {
        return $query->with([
            'product_infos',
            'product_ingredients',
        ]);
    }
}
