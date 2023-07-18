<?php

namespace App\Models;

use App\Models\Traits\BusinessInfoTraits\BusinessInfoMethods;
use App\Models\Traits\BusinessInfoTraits\BusinessInfoRelationships;
use App\Models\Traits\BusinessInfoTraits\BusinessInfoScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInfo extends Model
{
    use HasFactory, BusinessInfoRelationships, BusinessInfoMethods, BusinessInfoScopes;

    protected $guarded = [];
}
