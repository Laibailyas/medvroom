<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;

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
});

use App\Http\Controllers\Admin\InsuranceProviderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\ReviewController;

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('insurance-providers', InsuranceProviderController::class);
    Route::resource('users', UserController::class);
    Route::resource('doctors', DoctorController::class);
    Route::post('doctors/{doctor}/toggle-verify', [DoctorController::class, 'toggleVerification'])->name('doctors.toggle-verify');
    Route::resource('appointments', AppointmentController::class);
    Route::post('appointments/{appointment}/transition', [AppointmentController::class, 'transition'])->name('appointments.transition');
    Route::resource('specialties', SpecialtyController::class);
    Route::resource('symptoms', SymptomController::class);
    Route::resource('reviews', ReviewController::class);
});

require __DIR__.'/auth.php';
