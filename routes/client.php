<?php

use App\Http\Controllers\Client\OverviewController as ClientOverviewController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use App\Http\Controllers\Client\CompanyController as ClientCompanyController;
use App\Http\Controllers\Client\PaymentController as ClientPaymentController;
use App\Http\Controllers\Client\TeamController;
use App\Http\Controllers\Expert\AccountController as ExpertAccountController;

Route::middleware(['auth', 'route.protection'])->group(function () {

    // Overview Routes
    Route::get('/overview', [ClientOverviewController::class, 'index'])->name('client.overview.index');

    Route::group(["prefix" => "profile"], function () {
        Route::get('/', [ClientProfileController::class, 'index'])->name('client.profile.index');
    });
    Route::group(["prefix" => "projects"], function () {
        Route::get('/datatable', [ClientProjectController::class, 'datatable'])->name('client.projects.datatable');
        Route::get('/', [ClientProjectController::class, 'index'])->name('client.projects.index');
        Route::get('/create', [ClientProjectController::class, 'create'])->name('client.projects.create');
        Route::get('/{pid}', [ClientProjectController::class, 'show'])->name('client.projects.show');
        Route::post('/store', [ClientProjectController::class, 'store'])->name('client.projects.store');
    });
    Route::group(["prefix" => "company"], function () {
        Route::get('/', [ClientCompanyController::class, 'index'])->name('client.company.index');
        Route::get('/create', [ClientCompanyController::class, 'create'])->name('client.company.create');
        Route::post('/store', [ClientCompanyController::class, 'store'])->name('client.company.store');
    });
    Route::group(["prefix" => "team"], function () {
        Route::get('/', [TeamController::class, 'index'])->name('client.team.index');
        Route::get('/create', [TeamController::class, 'create'])->name('client.team.create');
        Route::post('/store', [TeamController::class, 'store'])->name('client.team.store');
    });
    Route::group(["prefix" => "account"], function () {
        Route::get('/', [ExpertAccountController::class, 'index'])->name('client.account.index');
        Route::get('/security', [ExpertAccountController::class, 'security'])->name('client.account.security');
        Route::get('/notification', [ExpertAccountController::class, 'notification'])->name('client.account.notification');
        Route::get('/activity', [ExpertAccountController::class, 'activity'])->name('client.account.activity');
    });
    Route::group(["prefix" => "payment"], function () {
        Route::get('/', [ClientPaymentController::class, 'index'])->name('client.payment.index');
        Route::get('/datatable', [ClientPaymentController::class, 'datatable'])->name('client.payment.datatable');
        Route::post('/store', [ClientPaymentController::class, 'store'])->name('client.payment.store');
    });
});
