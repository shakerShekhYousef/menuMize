<?php

use App\Http\Controllers\website\BusinessTypeController;
use App\Http\Controllers\website\CartController;
use App\Http\Controllers\website\LanguageController;
use App\Http\Controllers\website\CategoryController;
use App\Http\Controllers\website\OrderController;
use App\Http\Controllers\website\PackageController;
use App\Http\Controllers\website\ProductController;
use App\Http\Controllers\website\SpotlightDailyController;
use App\Http\Controllers\website\BusinessController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
});
Route::controller(CategoryController::class)->group(function () {
    Route::get('/get_business_categories', 'index');
    Route::get('/get_products_of_category', 'get_products_of_category');
});
Route::controller(PackageController::class)->group(function () {
    Route::get('/packages', 'index');
    Route::get('/packages/{package}', 'show');
});
Route::controller(BusinessTypeController::class)->group(function () {
    Route::get('/business_types', 'index');
});
Route::controller(SpotlightDailyController::class)->group(function () {
    Route::get('get_spotlight_daily_list', 'get_spotlight_daily_list');
    Route::get('get_products_by_spotlight_type', 'get_products_by_spotlight_type');
});
Route::controller(CartController::class)->group(function () {
    Route::post('add_product_to_cart', 'add_product_to_cart');
});
Route::controller(OrderController::class)->group(function () {
    Route::post('order_now', 'order_now');
    Route::get('order_details', 'order_details');
    Route::put('request_the_check/{order}', 'request_the_check');
});
Route::controller(LanguageController::class)->group(function () {
    Route::get('languages', 'index');
});
Route::controller(BusinessController::class)->group(function (){
    Route::get('get_business_info','get_business_info');
});
