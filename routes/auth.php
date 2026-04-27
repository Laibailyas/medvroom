<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\MobileVerificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ProviderOnboardingController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('register/doctor', fn () => redirect()->route('provider.register.entry'))
        ->name('register.doctor');

    Route::prefix('register/provider')->name('provider.register.')->group(function () {
        Route::get('/', [ProviderOnboardingController::class, 'entry'])->name('entry');

        // Steps available to guests (account creation)
        Route::get('/account', [ProviderOnboardingController::class, 'account'])->name('account');
        Route::post('/account', [ProviderOnboardingController::class, 'storeAccount'])->name('account.store');
    });
});

// Authenticated onboarding steps (logged in but not yet done)
Route::prefix('register/provider')->name('provider.register.')->middleware('auth')->group(function () {
    Route::get('/verify', [ProviderOnboardingController::class, 'verify'])->name('verify');
    Route::post('/verify', [ProviderOnboardingController::class, 'storeVerify'])->name('verify.store');

    Route::get('/identity', [ProviderOnboardingController::class, 'identity'])->name('identity');
    Route::post('/identity', [ProviderOnboardingController::class, 'storeIdentity'])->name('identity.store');

    Route::get('/npi', [ProviderOnboardingController::class, 'npi'])->name('npi');
    Route::get('/npi-lookup', [ProviderOnboardingController::class, 'npiLookup'])->name('npi.lookup');
    Route::post('/npi', [ProviderOnboardingController::class, 'storeNpi'])->name('npi.store');

    Route::get('/license', [ProviderOnboardingController::class, 'license'])->name('license');
    Route::post('/license', [ProviderOnboardingController::class, 'storeLicense'])->name('license.store');

    Route::get('/services', [ProviderOnboardingController::class, 'services'])->name('services');
    Route::post('/services', [ProviderOnboardingController::class, 'storeServices'])->name('services.store');

    Route::get('/schedule', [ProviderOnboardingController::class, 'schedule'])->name('schedule');
    Route::post('/schedule', [ProviderOnboardingController::class, 'storeSchedule'])->name('schedule.store');

    Route::get('/documents', [ProviderOnboardingController::class, 'documents'])->name('documents');
    Route::post('/documents', [ProviderOnboardingController::class, 'storeDocuments'])->name('documents.store');

    Route::get('/agreements', [ProviderOnboardingController::class, 'agreements'])->name('agreements');
    Route::post('/agreements', [ProviderOnboardingController::class, 'storeAgreements'])->name('agreements.store');

    Route::get('/review', [ProviderOnboardingController::class, 'review'])->name('review');
    Route::post('/review', [ProviderOnboardingController::class, 'submit'])->name('submit');

    Route::get('/success', [ProviderOnboardingController::class, 'success'])->name('success');
});

Route::middleware('guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::get('provider/login', [AuthenticatedSessionController::class, 'createProvider'])
        ->name('provider.login');

    Route::get('admin/login', [AuthenticatedSessionController::class, 'createAdmin'])
        ->name('admin.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    Route::get('auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
        ->name('social.redirect');

    Route::get('auth/{provider}/callback', [SocialAuthController::class, 'callback'])
        ->name('social.callback');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('verify-mobile', [MobileVerificationController::class, 'show'])
        ->name('verification.mobile.notice');

    Route::post('verify-mobile', [MobileVerificationController::class, 'verify'])
        ->middleware('throttle:6,1')
        ->name('verification.mobile.verify');

    Route::post('mobile/verification-notification', [MobileVerificationController::class, 'resend'])
        ->middleware('throttle:6,1')
        ->name('verification.mobile.resend');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
