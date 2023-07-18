<?php

use App\Http\Controllers\dashboard\admin\BusinessController;
use App\Http\Controllers\dashboard\admin\BusinessTypeController;
use App\Http\Controllers\dashboard\admin\OrderStatusController;
use App\Http\Controllers\dashboard\admin\PackageController;
use App\Http\Controllers\dashboard\admin\SocialLinkTypesController;
use App\Http\Controllers\dashboard\admin\SpotlightDailyTypeController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:api', 'role:admin'],
], function () {
    //Business Routes
    Route::apiResource('businesses', BusinessController::class);
    //Business Types Routes
    Route::apiResource('business_types', BusinessTypeController::class);
    //Packages Routes
    Route::apiResource('packages', PackageController::class);
    //Spotlight Daily Types Routes
    Route::apiResource('spotlight_daily_types', SpotlightDailyTypeController::class);
    //Social Links Types Routes
    Route::apiResource('social_link_types', SocialLinkTypesController::class);
    //Order status Routes
    Route::apiResource('order_statuses', OrderStatusController::class);
});
