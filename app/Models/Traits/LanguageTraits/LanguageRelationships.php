<?php

namespace App\Models\Traits\LanguageTraits;

use App\Models\Business;

trait LanguageRelationships
{
    public function Businesses()
    {
        return $this->hasMany(Business::class);
    }
}
