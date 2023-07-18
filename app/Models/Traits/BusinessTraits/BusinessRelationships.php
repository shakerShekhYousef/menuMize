<?php

namespace App\Models\Traits\BusinessTraits;

use App\Models\BusinessInfo;
use App\Models\BusinessRate;
use App\Models\BusinessSocialLink;
use App\Models\BusinessType;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\Package;
use App\Models\Product;
use App\Models\QrCode;
use App\Models\SpotlightDaily;
use App\Models\User;

trait BusinessRelationships
{
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function business_type()
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function main_language()
    {
        return $this->belongsTo(Language::class, 'main_language_id', 'id');
    }

    public function second_language()
    {
        return $this->belongsTo(Language::class, 'second_language_id', 'id');
    }

    public function business_infos()
    {
        return $this->hasMany(BusinessInfo::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function rates()
    {
        return $this->hasMany(BusinessRate::class);
    }

    public function qr_codes()
    {
        return $this->hasMany(QrCode::class);
    }

    public function spotlight_dailies()
    {
        return $this->hasMany(SpotlightDaily::class);
    }

    public function social_links()
    {
        return $this->hasMany(BusinessSocialLink::class);
    }
}
