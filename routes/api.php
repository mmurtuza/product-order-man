<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


Route::group(['api'], function () {

Route::apiResource('products', ProductController::class);
Route::apiResource('orders', OrderController::class);
})->middleware(['auth', 'verified']);
