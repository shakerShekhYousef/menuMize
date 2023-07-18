<?php

namespace App\Models;

use App\Models\Traits\BusinessTraits\BusinessMethods;
use App\Models\Traits\BusinessTraits\BusinessRelationships;
use App\Models\Traits\BusinessTraits\BusinessScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory, BusinessRelationships, BusinessMethods, BusinessScopes;

    protected $guarded = [];
}
