<?php

use App\Http\Controllers\WeatherController;
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
Route::group(['middleware' => 'weather'], function () {
    Route::get('weather/{city}', [WeatherController::class, 'show']);
    Route::get('daily-weather/{city}', [WeatherController::class, 'showByDate']);
});



