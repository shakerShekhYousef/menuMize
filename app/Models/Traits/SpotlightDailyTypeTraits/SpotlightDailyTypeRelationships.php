<?php

namespace App\Models\Traits\SpotlightDailyTypeTraits;

use App\Models\Business;

trait SpotlightDailyTypeRelationships
{
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
