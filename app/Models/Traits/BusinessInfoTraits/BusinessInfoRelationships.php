<?php

namespace App\Models\Traits\BusinessInfoTraits;

use App\Models\Business;

trait BusinessInfoRelationships
{
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
