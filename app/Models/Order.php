<?php

namespace App\Models;

use App\Models\Traits\OrderTraits\OrderMethods;
use App\Models\Traits\OrderTraits\OrderRelationships;
use App\Models\Traits\OrderTraits\OrderScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, OrderMethods, OrderRelationships, OrderScopes;

    protected $guarded = [];
}
