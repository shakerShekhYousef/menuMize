<?php

namespace App\Models;

use App\Models\Traits\OfferTraits\OfferMethods;
use App\Models\Traits\OfferTraits\OfferRelationships;
use App\Models\Traits\OfferTraits\OfferScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory, OfferMethods, OfferRelationships, OfferScopes;

    protected $guarded = [];
}
