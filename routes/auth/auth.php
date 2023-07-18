<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
], function () {
    //Register
    Route::post('register', [AuthController::class, 'register']);
    //Login
    Route::post('login', [AuthController::class, 'login']);
});
