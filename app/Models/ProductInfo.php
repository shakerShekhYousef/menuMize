<?php

namespace App\Models;

use App\Models\Traits\ProductInfoTraits\ProductInfoRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    use HasFactory, ProductInfoRelationships;

    protected $guarded = [];
}
