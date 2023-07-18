<?php

namespace App\Models;

use App\Models\Traits\CityTraits\CityScopes;
use App\Models\Traits\CountryTraits\CountryMethods;
use App\Models\Traits\CountryTraits\CountryRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, CountryRelationships, CountryMethods, CityScopes;

    protected $guarded = [];
}
