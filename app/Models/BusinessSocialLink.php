<?php

namespace App\Models;

use App\Models\Traits\BusinessSocialLinkTraits\BusinessSocialLinkMethods;
use App\Models\Traits\BusinessSocialLinkTraits\BusinessSocialLinkRelationships;
use App\Models\Traits\BusinessSocialLinkTraits\BusinessSocialLinkScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSocialLink extends Model
{
    use HasFactory, BusinessSocialLinkMethods, BusinessSocialLinkRelationships, BusinessSocialLinkScopes;

    protected $guarded = [];
}
