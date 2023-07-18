<?php

namespace App\Models\Traits\ProductIngrediantTraits;

use App\Models\ProductIngredient;

trait ProductIngredientRelationship
{
    public function product()
    {
        return $this->belongsTo(ProductIngredient::class);
    }
}
