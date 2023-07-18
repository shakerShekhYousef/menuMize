<?php

namespace App\Models;

use App\Models\Traits\PackageTraits\PackageMethods;
use App\Models\Traits\PackageTraits\PackageRelationships;
use App\Models\Traits\PackageTraits\PackageScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory, PackageMethods, PackageRelationships, PackageScopes;

    protected $guarded = [];
}
