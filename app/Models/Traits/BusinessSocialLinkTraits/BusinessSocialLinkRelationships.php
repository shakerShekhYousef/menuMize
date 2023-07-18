<?php

namespace App\Models\Traits\BusinessSocialLinkTraits;

use App\Models\Business;
use App\Models\SocialLinkType;

trait BusinessSocialLinkRelationships
{
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function social_type()
    {
        return $this->belongsTo(SocialLinkType::class);
    }
}
