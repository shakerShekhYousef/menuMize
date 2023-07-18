<?php

namespace App\Models;

use App\Models\Traits\CityTraits\CityMethods;
use App\Models\Traits\CityTraits\CityRelationships;
use App\Models\Traits\CityTraits\CityScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, CityMethods, CityRelationships, CityScopes;

    protected $guarded = [];
}
