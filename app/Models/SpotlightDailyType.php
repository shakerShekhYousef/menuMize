<?php

namespace App\Models;

use App\Models\Traits\SpotlightDailyTypeTraits\SpotlightDailyTypeMethods;
use App\Models\Traits\SpotlightDailyTypeTraits\SpotlightDailyTypeRelationships;
use App\Models\Traits\SpotlightDailyTypeTraits\SpotlightDailyTypeScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotlightDailyType extends Model
{
    use HasFactory, SpotlightDailyTypeMethods, SpotlightDailyTypeRelationships, SpotlightDailyTypeScopes;

    protected $guarded = [];
}
