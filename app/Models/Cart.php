<?php

namespace App\Models;

use App\Models\Traits\CartTraits\CartMethods;
use App\Models\Traits\CartTraits\CartRelationships;
use App\Models\Traits\CartTraits\CartScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, CartRelationships, CartMethods, CartScopes;

    protected $guarded = [];
}
