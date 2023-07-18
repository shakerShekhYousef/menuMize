<?php

namespace App\Models;

use App\Models\Traits\CategoryInfoTraits\CategoryInfoRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryInfo extends Model
{
    use HasFactory, CategoryInfoRelationships;

    protected $guarded = [];
}
