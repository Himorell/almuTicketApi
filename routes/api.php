<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StateController;
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

//Route::get('/', [IncidenceController::class, 'index'])->name('incidencesApi');
Route::get('/states', [StateController::class, 'index'])->name('statesApi');
Route::delete('/deleteState/{id}',[StateController::class,'destroy'])->name('destroyStateApi');
Route::post('/createState',[StateController::class,'store'])->name('createStateApi');

