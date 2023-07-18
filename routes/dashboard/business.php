<?php

use App\Http\Controllers\dashboard\business\CategoryController;
use App\Http\Controllers\dashboard\business\OrderController;
use App\Http\Controllers\dashboard\business\ProductController;
use App\Http\Controllers\dashboard\business\ProfileController;
use App\Http\Controllers\dashboard\business\QrController;
use App\Http\Controllers\dashboard\business\SpotlightDailyController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'business',
    'middleware' => ['auth:api', 'role:business'],
], function () {
    //Product Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::post('/products', 'store');
        Route::patch('/products/{product}', 'update');
        Route::get('/products/{product}', 'show');
        Route::delete('/products/{product}', 'destroy');
        Route::post('add_products_to_category', 'add_products_to_category');
    });
    //Category Routes
    Route::controller(CategoryController::class)->group(function () {
        Route::post('/categories', 'store');
        Route::put('/categories/{category}', 'update');
        Route::get('/categories/{category}', 'show');
        Route::delete('/categories/{category}', 'destroy');
        Route::get('/categories', 'index');
    });
    //Qr Routes
    Route::controller(QrController::class)->group(function () {
        Route::post('/generate_qr', 'generate');
        Route::delete('/delete_qr/{qrCode}', 'delete_qr_code');
    });
    //Spotlight Dailies Routes
    Route::controller(SpotlightDailyController::class)->group(function () {
        Route::get('spotlight_dailies', 'index');
        Route::post('add_products_to_spotlight', 'add_products_to_spotlight');
        Route::get('get_products_by_spotlight_type', 'get_products_by_spotlight_type');
    });
    //Business Profile Routes
    Route::controller(ProfileController::class)->group(function () {
        Route::post('update_social_links', 'update_social_links');
        Route::post('update_business_profile', 'update_profile');
    });
    //Order Routes
    Route::controller(OrderController::class)->group(function () {
        Route::get('orders', 'index');
        Route::get('orders/{order}', 'show');
        Route::put('update_order_status/{order}', 'update');
        Route::delete('orders/{order}', 'destroy');
    });
});
