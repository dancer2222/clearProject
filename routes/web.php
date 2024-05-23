<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [TestController::class, 'index']);

Route::resource('orders', OrderController::class)
    ->only(['index', 'show', 'update', 'store', 'destroy']);
Route::resource('products', ProductController::class)
    ->only(['index', 'show', 'update', 'store', 'destroy']);

