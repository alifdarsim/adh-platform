<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\Expert\AwardedController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\IndustryExpertController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProjectAwardedController;
use App\Http\Controllers\ProjectInvitationController;

Route::get('/test', function () {
    return view('mail.project_invitation');
});

Route::get('project-invitation/{token}', [ProjectInvitationController::class, 'index'])->name('project-invitation.index');
Route::get('project-awarded/{token}', [ProjectAwardedController::class, 'index'])->name('project-awarded.index');
Route::get('logout', function () {
    auth()->logout();
    return redirect()->route('login.index', ['type' => 'expert']);
});

// User type redirects
Route::get('/', function () {
    if (Auth::check()) {
        if (session('user_type') == 'admin' || session('user_type') == 'super admin') return redirect()->route('admin.overview.index');
        else if (session('user_type') == 'expert') return redirect()->route('expert.overview');
        else if (session('user_type') == 'client') return redirect()->route('client.overview');
        else auth()->logout();
    }
    return redirect()->route('login.index', ['type' => 'expert']);
});

// Auth Routes with Middleware
Route::group(["prefix" => "auth", "middleware" => ['set.locale']], function () {
    // Login and Register Routes
    Route::get('/login/{type}', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login/{type}', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
    // Social Auth Routes
    Route::get('login/social/{driver}/{user_type}/{timezone}', [SocialLoginController::class, 'redirectToDriver'])->name('login.authenticate.social');
    Route::get('callback/{driver}', [SocialLoginController::class, 'handleCallback']);
    // Register Routes
    Route::get('/register/{type}', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register/{type}', [RegisterController::class, 'store'])->name('register.store');
    // Password Reset Routes
    Route::get('/forgot-password', [PasswordResetController::class, 'index'])->name('forgot_password.index');
    Route::get('/forgot-password/{token}', [PasswordResetController::class, 'reset'])->name('forgot_password.reset');
    Route::put('/forgot-password/{token}', [PasswordResetController::class, 'update'])->name('forgot_password.update');
    Route::post('/forgot-password/{email}', [PasswordResetController::class, 'password_reset'])->name('forgot_password.store');
});

// Admin Invitation Routes
Route::get('/invitation/{token}', [AdminsController::class, 'invitation'])->name('admin.invitation');
Route::post('/invitation', [AdminsController::class, 'invitationPassword'])->name('admin.password-invitation');
Route::get('/account-confirmation/{token}', [RegisterController::class, 'verify'])->name('register.confirm');
Route::get('/account-removal/{token}', [RegisterController::class, 'remove_account'])->name('register.remove_account');

Route::middleware(['set.locale'])->group(function () {
    // Policy and Terms Routes
    Route::get('/privacy-policy', function () { return view('others.policy'); })->name('others.policy');
    Route::get('/terms-condition', function () { return view('others.terms'); })->name('others.terms');
});

Route::middleware(['auth', 'route.protection'])->group(function () {

    // Awarded Project Route
    Route::post('/project/uploadEvent', [AwardedController::class, 'uploadEvent'])->name('expert.awarded.upload');
    Route::post('/project/downloadEvent', [AwardedController::class, 'downloadEvent'])->name('expert.awarded.download');
    Route::post('/project/deleteEvent', [AwardedController::class, 'deleteEvent'])->name('expert.awarded.delete');
    Route::post('/project/updateEvent', [AwardedController::class, 'updateEvent'])->name('expert.awarded.update');
    Route::get('/chat/{pid}', [ChatController::class, 'getMessage'])->name('expert.chat.get');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('expert.chat.send');

});

Route::middleware(['auth'])->group(function () {
    Route::put('/company/update', [CompaniesController::class, 'update'])->name('company.update');
    Route::get('/company/search', [CompaniesController::class, 'search'])->name('company.search');
    Route::get('/company/types', [CompaniesController::class, 'types'])->name('company.types');

    Route::get('/industries', [IndustryController::class, 'index'])->name('industries.index');
    Route::get('/industries/{type}', [IndustryController::class, 'type'])->name('industries.type');
    Route::get('/industry_expert', [IndustryExpertController::class, 'main'])->name('industries_expert.main');
    Route::get('/industry_expert/{main}', [IndustryExpertController::class, 'sub'])->name('industries_expert.sub');
    Route::get('/companies/{id}', [CompaniesController::class, 'get'])->name('companies.get');
    Route::get('/address/cities/search', [AddressController::class, 'cities_search'])->name('cities.search');
    Route::get('/address/states/search', [AddressController::class, 'states_search'])->name('states.search');
    Route::get('/address/countries', [AddressController::class, 'countries'])->name('countries.index');
    Route::get('/address/countries/search', [AddressController::class, 'countries_search'])->name('countries.search');
});



