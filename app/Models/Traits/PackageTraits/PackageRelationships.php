<?php

namespace App\Models\Traits\PackageTraits;

use App\Models\Business;

trait PackageRelationships
{
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
