<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoomController;

use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\TicketController;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\IncidenceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/tickets', [TicketController::class, 'index'])->name('ticketsApi');

Route::get('/incidences', [IncidenceController::class, 'index'])->name('incidencesApi');
Route::delete('/deleteIncidence/{id}', [IncidenceController::class, 'destroy'])->name('destroyIncidenceApi');
Route::post('/createIncidence', [IncidenceController::class, 'store'])->name('createIncidenceApi');
Route::put('/updateIncidence/{id}', [IncidenceController::class, 'update'])->name('updateIncidenceApi');

Route::apiResource('incidences', IncidenceController::class);

Route::get('/bookings', [BookingController::class, 'index'])->name('bookingsApi');
Route::delete('/deleteBooking/{id}', [BookingController::class, 'destroy'])->name('destroyBookingApi');
Route::post('/createBooking', [BookingController::class, 'store'])->name('createBookingApi');
Route::put('/updateBooking/{id}', [BookingController::class, 'update'])->name('updateBookingApi');

Route::get('/states', [StateController::class, 'index'])->name('statesApi');
Route::delete('/deleteState/{id}',[StateController::class,'destroy'])->name('destroyStateApi');
Route::post('/createState',[StateController::class,'store'])->name('createStateApi');
Route::put('/updateState/{id}', [StateController::class, 'update'])->name('updateStateApi');

Route::get('/locations', [LocationController::class, 'index'])->name('locationsApi');
Route::post('/createLocation', [LocationController::class,'store'])->name('createLocationApi');
Route::put('/updateLocation/{id}', [LocationController::class,'update'])->name('updateLocationApi');
Route::delete('/deleteLocation/{id}', [LocationController::class,'destroy'])->name('destroyLocationApi');

Route::get('/areas', [AreaController::class, 'index'])->name('areasApi');
Route::delete('/deleteArea/{id}', [AreaController::class, 'destroy'])->name('destroyAreaApi');
Route::post('/createArea', [AreaController::class, 'store'])->name('createAreaApi');
Route::put('/updateArea/{id}',[AreaController::class, 'update'])->name('updateAreaApi');

Route::get('/rooms', [RoomController::class, 'index'])->name('roomsApi');
Route::delete('/deleteRoom/{id}', [RoomController::class, 'destroy'])->name('destroyRoomApi');
Route::post('/createRoom', [RoomController::class, 'store'])->name('createRoomApi');
Route::put('/updateRoom/{id}', [RoomController::class, 'update'])->name('updateRoomApi');

Route::get('/categories', [CategoryController::class, 'index'])->name('categoriesApi');
Route::delete('/deleteCategory/{id}', [CategoryController::class, 'destroy'])->name('destroyCategoryApi');
Route::post('/createCategory', [CategoryController::class, 'store'])->name('createCategoryApi');
Route::put('/updateCategory/{id}', [CategoryController::class, 'update'])->name('updateCategoryApi');

Route::get('/users', [UserController::class, 'index'])->name('usersApi');
Route::delete('/deleteUser/{id}', [UserController::class, 'destroy'])->name('destroyUserApi');
Route::post('/createUser', [UserController::class, 'store'])->name('createUserApi');
Route::put('/updateUser/{id}', [UserController::class, 'update'])->name('updateUserApi');


