<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('myTickets', [AuthController::class, 'myTickets'])->name('myTickets');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('home', [UserController::class, 'home'])->name('home');

});

Route::get('/tickets', [TicketController::class, 'index'])->name('ticketsApi')->middleware('isAdmin','auth');

Route::get('/incidences', [IncidenceController::class, 'index'])->name('incidencesApi')->middleware('auth');
Route::get('/incidence/{id}', [IncidenceController::class, 'show'])->name('incidenceShowApi')->middleware('auth');
Route::delete('/deleteIncidence/{id}', [IncidenceController::class, 'destroy'])->name('destroyIncidenceApi')->middleware('auth');
Route::post('/createIncidence', [IncidenceController::class, 'store'])->name('createIncidenceApi')->middleware('auth');
Route::put('/updateIncidence/{id}', [IncidenceController::class, 'update'])->name('updateIncidenceApi')->middleware('isAdmin','auth');

Route::get('/bookings', [BookingController::class, 'index'])->name('bookingsApi')->middleware('auth');
Route::get('/booking/{id}', [BookingController::class, 'show'])->name('bookingShowApi')->middleware('auth');
Route::delete('/deleteBooking/{id}', [BookingController::class, 'destroy'])->name('destroyBookingApi')->middleware('auth');
Route::post('/createBooking', [BookingController::class, 'store'])->name('createBookingApi')->middleware('auth');
Route::put('/updateBooking/{id}', [BookingController::class, 'update'])->name('updateBookingApi')->middleware('isAdmin','auth');


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
Route::put('/updateUser/{id}', [UserController::class, 'update'])->name('updateUserApi');
