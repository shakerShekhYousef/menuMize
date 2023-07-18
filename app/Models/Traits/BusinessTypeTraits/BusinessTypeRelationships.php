<?php

namespace App\Models\Traits\BusinessTypeTraits;

use App\Models\Business;

trait BusinessTypeRelationships
{
    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
