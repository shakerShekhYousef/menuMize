<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('config', function () {
    \Illuminate\Support\Facades\Artisan::call('config:cache');

    return 'success';
});

Route::get('route-cache', function () {
    \Illuminate\Support\Facades\Artisan::call('route:cache');

    return 'success';
});

Route::get('migrate', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh --seed');

    return 'success';
});
Route::get('optimize', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');

    return 'success';
});
