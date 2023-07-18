<?php

namespace App\Models\Traits\CountryTraits;

use App\Models\City;

trait CountryRelationships
{
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
