<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::post('/customers', [CustomerController::class, 'store']);


Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders', [OrderController::class, 'index']);
Route::put('/orders/{order}', [OrderController::class, 'update']);
Route::get('/orders/stats', [OrderController::class, 'stats']);