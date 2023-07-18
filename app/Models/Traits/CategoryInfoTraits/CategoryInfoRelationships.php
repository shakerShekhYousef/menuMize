<?php

namespace App\Models\Traits\CategoryInfoTraits;

use App\Models\Category;

trait CategoryInfoRelationships
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
