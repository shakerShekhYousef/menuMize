<?php

namespace App\Models\Traits\CityTraits;

use App\Models\Country;

trait CityRelationships
{
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
