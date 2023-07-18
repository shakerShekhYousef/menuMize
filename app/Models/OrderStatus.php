<?php

namespace App\Models;

use App\Models\Traits\OrderStatusTraits\OrderStatusRelationships;
use App\Models\Traits\OrderStatusTraits\OrderStatusScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory, OrderStatusRelationships, OrderStatusScopes;

    protected $guarded = [];
}
