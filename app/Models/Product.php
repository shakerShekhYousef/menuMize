<?php

namespace App\Models;

use App\Models\Traits\ProductTraits\ProductRelationships;
use App\Models\Traits\ProductTraits\ProductScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, ProductRelationships, ProductScopes;

    protected $guarded = [];
}
