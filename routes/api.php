<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


Route::middleware('auth:sanctum')->group(function () {

Route::apiResource('products', ProductController::class);
Route::apiResource('orders', OrderController::class);
});
