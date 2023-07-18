<?php

namespace App\Models\Traits\QrCodeTraits;

use App\Models\Business;

trait QrCodeRelationships
{
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
