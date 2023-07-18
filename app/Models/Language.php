<?php

namespace App\Models;

use App\Models\Traits\LanguageTraits\LanguageMethods;
use App\Models\Traits\LanguageTraits\LanguageRelationships;
use App\Models\Traits\LanguageTraits\LanguageScopes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory,LanguageMethods,LanguageRelationships,LanguageScopes;

    protected $guarded = [];
}
