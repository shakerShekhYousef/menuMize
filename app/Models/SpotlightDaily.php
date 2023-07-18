<?php

namespace App\Models;

use App\Models\Traits\SpotlightDailyTraits\SpotlightDailyMethods;
use App\Models\Traits\SpotlightDailyTraits\SpotlightDailyRelationships;
use App\Models\Traits\SpotlightDailyTraits\SpotlightDailyScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotlightDaily extends Model
{
    use HasFactory, SpotlightDailyScopes, SpotlightDailyMethods, SpotlightDailyRelationships;

    protected $guarded = [];
}
