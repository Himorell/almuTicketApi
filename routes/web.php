<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\IncidenceController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('states', StateController::class);
Route::resource('areas', AreaController::class);
Route::resource('locations', LocationController::class);
Route::resource('categories', CategoryController::class);
Route::resource('incidences', IncidenceController::class);
Route::resource('bookings', BookingController::class);





