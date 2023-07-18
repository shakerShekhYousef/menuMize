<?php

namespace App\Models\Traits\SocialLinkTypeTraits;

use App\Models\BusinessSocialLink;

trait SocialLinkTypeRelationships
{
    public function social_links()
    {
        return $this->hasMany(BusinessSocialLink::class);
    }
}
