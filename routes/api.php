<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\DoctorApiController;
use App\Http\Controllers\api\AppointmentApiController;
use App\Http\Controllers\api\LoginController;

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
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('doctors/availability', [DoctorApiController::class, 'index']);
    Route::post('doctors/availability', [DoctorApiController::class, 'store']);
    Route::get('doctors/{id}/availability', [DoctorApiController::class, 'edit']);


    Route::get('appointments', [AppointmentApiController::class, 'index']);
    Route::get('appointments/{patient_id}', [AppointmentApiController::class, 'edit']);
    Route::post('appointments/book', [AppointmentApiController::class, 'store']);
    Route::get('/appointments/{doctor_id}', [AppointmentApiController::class, 'doctors_appointment']);
});
