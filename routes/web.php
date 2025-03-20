<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DoctorAvailabilitiesController;
use App\Http\Controllers\AppointmentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //All Doctors route
    Route::get('/doctors', [DoctorAvailabilitiesController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [DoctorAvailabilitiesController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [DoctorAvailabilitiesController::class, 'store'])->name('doctors.store');

    
    //All Appointment route
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/time-slots/{doctor_id}', [AppointmentController::class, 'getTimeSlots'])->name('appointments.time-slots');

});

require __DIR__.'/auth.php';
