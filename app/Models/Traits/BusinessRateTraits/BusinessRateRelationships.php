<?php

namespace App\Models\Traits\BusinessRateTraits;

use App\Models\Business;

trait BusinessRateRelationships
{
    public function Business()
    {
        return $this->belongsTo(Business::class);
    }
}
