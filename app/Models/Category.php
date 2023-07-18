<?php

namespace App\Models;

use App\Models\Traits\CategoryTraits\CategoryMethods;
use App\Models\Traits\CategoryTraits\CategoryRelationships;
use App\Models\Traits\CategoryTraits\CategoryScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, CategoryMethods, CategoryRelationships, CategoryScopes;

    protected $guarded = [];
}
