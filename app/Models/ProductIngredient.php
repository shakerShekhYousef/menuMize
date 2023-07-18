<?php

namespace App\Models;

use App\Models\Traits\ProductIngrediantTraits\ProductIngredientRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductIngredient extends Model
{
    use HasFactory,ProductIngredientRelationship;

    protected $guarded = [];
}
