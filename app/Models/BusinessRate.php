<?php

namespace App\Models;

use App\Models\Traits\BusinessRateTraits\BusinessRateRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessRate extends Model
{
    use HasFactory, BusinessRateRelationships;

    protected $guarded = [];
}
