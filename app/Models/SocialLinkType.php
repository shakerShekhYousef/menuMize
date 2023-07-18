<?php

namespace App\Models;

use App\Models\Traits\SocialLinkTypeTraits\SocialLinkTypeMethods;
use App\Models\Traits\SocialLinkTypeTraits\SocialLinkTypeRelationships;
use App\Models\Traits\SocialLinkTypeTraits\SocialLinkTypeScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLinkType extends Model
{
    use HasFactory, SocialLinkTypeMethods, SocialLinkTypeRelationships, SocialLinkTypeScopes;

    protected $guarded = [];
}
