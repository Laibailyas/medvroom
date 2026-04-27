<?php

use App\Http\Controllers\Admin\BlogCategoryController as AdminBlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HelpArticleController;
use App\Http\Controllers\Admin\HelpCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HelpController;
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

// Booking Flow
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/booking/review', [BookingController::class, 'review'])->name('booking.review');
    Route::post('/booking/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');
});

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/review-policy', [PageController::class, 'reviewPolicy'])->name('review-policy');
Route::get('/telehealth-consent', [PageController::class, 'telehealthConsent'])->name('telehealth-consent');
Route::get('/provider-agreement', [PageController::class, 'providerAgreement'])->name('provider-agreement');
Route::get('/acceptable-use-policy', [PageController::class, 'acceptableUsePolicy'])->name('acceptable-use-policy');
Route::get('/cookie-policy', [PageController::class, 'cookiePolicy'])->name('cookie-policy');

// Help Center (Frontend)
Route::prefix('help')->name('help.')->group(function () {
    Route::get('/', [HelpController::class, 'index'])->name('index');
    Route::get('/{category:slug}', [HelpController::class, 'category'])->name('category');
    Route::get('/article/{article:slug}', [HelpController::class, 'article'])->name('article');
});

// Blog (Frontend)
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [BlogController::class, 'show'])->name('show');
});

Route::get('/dashboard', function () {
    /** @var User $user */
    $user = auth()->user();
    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->isDoctor()) {
        return redirect()->route('doctor.dashboard');
    }

    return redirect()->route('patient.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Doctor Portal Routes
Route::middleware(['auth', 'verified', 'doctor'])->prefix('doctor')->as('doctor.')->group(function () {
    Route::get('/dashboard', App\Http\Controllers\Doctor\DashboardController::class)->name('dashboard');
    Route::get('/appointments', [App\Http\Controllers\Doctor\AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [App\Http\Controllers\Doctor\AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');

    Route::post('/appointments/{appointment}/status', [App\Http\Controllers\Doctor\AppointmentController::class, 'updateStatus'])->name('appointments.status');
    Route::post('/appointments/{appointment}/reschedule', [App\Http\Controllers\Doctor\AppointmentController::class, 'reschedule'])->name('appointments.reschedule');

    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');

    Route::get('/chat', [ConversationController::class, 'doctorIndex'])->name('chat.index');
    Route::get('/chat/{conversation}', [ConversationController::class, 'doctorIndex'])->name('chat.show');

    Route::get('/payouts', [PayoutController::class, 'index'])->name('payouts.index');
    Route::post('/payouts/connect', [PayoutController::class, 'connect'])->name('payouts.connect');

    Route::get('/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Doctor\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/insurance', [InsuranceController::class, 'index'])->name('insurance.index');
    Route::patch('/insurance', [InsuranceController::class, 'update'])->name('insurance.update');

    Route::get('/reviews', [App\Http\Controllers\Doctor\ReviewController::class, 'index'])->name('reviews.index');
});

// Common Authenticated Routes (API Chat endpoints)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/messages/{conversation?}', [ConversationController::class, 'index'])->name('messages.index');
    Route::get('/conversations/{conversation}/messages', [ConversationController::class, 'fetchMessages'])->name('conversations.messages.index');
    Route::post('/conversations/{conversation}/messages', [ConversationController::class, 'sendMessage'])->name('conversations.messages.store');
    Route::delete('/conversations/{conversation}/messages/{message}', [ConversationController::class, 'deleteMessage'])->name('conversations.messages.destroy');
});

Route::middleware(['auth', 'verified', 'patient'])->prefix('patient')->as('patient.')->group(function () {
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointments', [PatientDashboardController::class, 'appointments'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [PatientDashboardController::class, 'show'])->name('appointments.show');
    Route::get('/appointments/{appointment}/reschedule', [PatientDashboardController::class, 'reschedule'])->name('appointments.reschedule');
    Route::post('/appointments/{appointment}/reschedule', [PatientDashboardController::class, 'updateReschedule'])->name('appointments.update-reschedule');
    Route::post('/appointments/{appointment}/reply-reschedule', [PatientDashboardController::class, 'replyReschedule'])->name('appointments.reply-reschedule');
    Route::post('/well-guide/{itemId}/toggle', [PatientDashboardController::class, 'toggleWellGuide'])->name('well-guide.toggle');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\InsuranceProviderController;
use App\Http\Controllers\Admin\MailLogController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\ContentSettingController;
use App\Http\Controllers\Admin\SmsLogController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\SystemSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\Doctor\InsuranceController;
use App\Http\Controllers\Doctor\PatientController;
use App\Http\Controllers\Doctor\PayoutController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Models\User;

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('insurance-providers', InsuranceProviderController::class);
    Route::resource('users', UserController::class);
    Route::resource('providers', ProviderController::class)->parameters(['providers' => 'doctor']);
    Route::post('providers/{doctor}/toggle-verify', [ProviderController::class, 'toggleVerification'])->name('providers.toggle-verify');
    Route::post('providers/{doctor}/decide', [ProviderController::class, 'decide'])->name('providers.decide');
    Route::resource('appointments', AppointmentController::class);
    Route::post('appointments/{appointment}/transition', [AppointmentController::class, 'transition'])->name('appointments.transition');
    Route::resource('specialties', SpecialtyController::class);
    Route::resource('symptoms', SymptomController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('mail-logs', MailLogController::class)->only(['index', 'show']);
    Route::resource('sms-logs', SmsLogController::class)->only(['index', 'show']);
    Route::get('settings', [SystemSettingController::class, 'index'])->name('settings.index');
    Route::patch('settings/{setting}', [SystemSettingController::class, 'update'])->name('settings.update');
    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
    Route::get('content-settings', [ContentSettingController::class, 'index'])->name('content-settings.index');
    Route::put('content-settings', [ContentSettingController::class, 'update'])->name('content-settings.update');

    // Help Center Management
    Route::prefix('help')->name('help.')->group(function () {
        Route::post('categories/reorder', [HelpCategoryController::class, 'reorder'])->name('categories.reorder');
        Route::resource('categories', HelpCategoryController::class);

        Route::post('articles/reorder', [HelpArticleController::class, 'reorder'])->name('articles.reorder');
        Route::resource('articles', HelpArticleController::class);
    });

    // Blog Management
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::post('categories/reorder', [AdminBlogCategoryController::class, 'reorder'])->name('categories.reorder');
        Route::resource('categories', AdminBlogCategoryController::class);
        Route::resource('posts', AdminBlogPostController::class);
    });
});

require __DIR__.'/auth.php';
