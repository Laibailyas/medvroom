<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Patient\DashboardController as PatientDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Models\InsuranceProvider;
use App\Models\Specialty;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $specialties = Specialty::all();
    $featuredInsurances = InsuranceProvider::where('is_featured', true)->get();

    return view('welcome', compact('specialties', 'featuredInsurances'));
});

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/doctors/{doctor}', [SearchController::class, 'showDoctor'])->name('doctors.show');

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');

Route::get('/dashboard', function () {
    /** @var User $user */
    $user = auth()->user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('patient.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'patient'])->prefix('patient')->as('patient.')->group(function () {
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
    Route::post('/well-guide/{itemId}/toggle', [PatientDashboardController::class, 'toggleWellGuide'])->name('well-guide.toggle');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\InsuranceProviderController;
use App\Http\Controllers\Admin\MailLogController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SmsLogController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\SystemSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Models\User;

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
    Route::resource('mail-logs', MailLogController::class)->only(['index', 'show']);
    Route::resource('sms-logs', SmsLogController::class)->only(['index', 'show']);
    Route::get('settings', [SystemSettingController::class, 'index'])->name('settings.index');
    Route::patch('settings/{setting}', [SystemSettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
