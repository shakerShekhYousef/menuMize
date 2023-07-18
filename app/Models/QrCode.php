<?php

namespace App\Models;

use App\Models\Traits\QrCodeTraits\QrCodeMethods;
use App\Models\Traits\QrCodeTraits\QrCodeRelationships;
use App\Models\Traits\QrCodeTraits\QrCodeScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    use HasFactory, QrCodeMethods, QrCodeRelationships, QrCodeScopes;

    protected $guarded = [];
}
