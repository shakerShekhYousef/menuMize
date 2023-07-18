<?php

namespace App\Models;

use App\Models\Traits\BusinessTypeTraits\BusinessTypeMethods;
use App\Models\Traits\BusinessTypeTraits\BusinessTypeRelationships;
use App\Models\Traits\BusinessTypeTraits\BusinessTypeScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    use HasFactory, BusinessTypeRelationships, BusinessTypeMethods, BusinessTypeScopes;

    protected $guarded = [];
}
