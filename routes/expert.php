<?php

use App\Http\Controllers\Expert\AssessmentController;
use App\Http\Controllers\Expert\AwardedController;
use App\Http\Controllers\Expert\OverviewController;
use App\Http\Controllers\Expert\ProfileController as ExpertProfileController;
use App\Http\Controllers\Expert\ProjectsController as ExpertProjectsController;
use App\Http\Controllers\Expert\AccountController;
use App\Http\Controllers\Expert\PaymentController;
use App\Http\Controllers\Expert\ContractController;
use App\Http\Controllers\Expert\RefererController;

Route::middleware(['auth', 'route.protection'])->group(function () {

    // Overview Routes
    Route::get('/overview', [OverviewController::class, 'index'])->name('expert.overview.index');

    // Project Routes
    Route::group(["prefix" => "projects"], function () {
        Route::get('/', [ExpertProjectsController::class, 'index'])->name('expert.projects.index');
        Route::get('/datatable', [ExpertProjectsController::class, 'datatable'])->name('expert.projects.datatable');
        Route::get('/datatable_public', [ExpertProjectsController::class, 'datatable_public'])->name('expert.projects.datatable_public');
        Route::post('/respond', [ExpertProjectsController::class, 'respond'])->name('expert.projects.respond');
        Route::get('/{pid}', [ExpertProjectsController::class, 'show'])->name('expert.projects.show');
        Route::post('/accept', [ExpertProjectsController::class, 'accept'])->name('expert.projects.accept');
        Route::post('/report', [ExpertProjectsController::class, 'report'])->name('expert.projects.report');
        Route::post('/answer-enquiries', [ExpertProjectsController::class, 'answer_enquiries'])->name('expert.projects.answer-enquiries');
    });

    Route::get('/invited-projects', [ExpertProjectsController::class, 'invited'])->name('expert.projects.invited');
    Route::get('/invited-projects/datatable', [ExpertProjectsController::class, 'datatable_invited'])->name('expert.projects.datatable_invited');
    Route::get('/invited-projects/{pid}', [ExpertProjectsController::class, 'public_show'])->name('expert.projects-public.show');

    Route::get('/public-projects', [ExpertProjectsController::class, 'public'])->name('expert.projects.public');
    Route::get('/public-projects/{pid}', [ExpertProjectsController::class, 'public_show'])->name('expert.projects-public.show');

    // Profile Routes
    Route::group(["prefix" => "profile"], function () {
        Route::get('/', [ExpertProfileController::class, 'index'])->name('expert.profile.index');
        Route::post('/update', [ExpertProfileController::class, 'update'])->name('expert.profile.update');
        Route::post('/linkedin', [ExpertProfileController::class, 'linkedin'])->name('expert.profile.linkedin');
        Route::post('/linkedin_sync', [ExpertProfileController::class, 'linkedin_sync'])->name('expert.profile.linkedin_sync');
        Route::post('/cv', [ExpertProfileController::class, 'cv'])->name('expert.profile.cv');
        Route::post('/job_add', [ExpertProfileController::class, 'job_add'])->name('expert.profile.job_add');
        Route::delete('/job-remove', [ExpertProfileController::class, 'jobRemove'])->name('expert.profile.job-remove');
        Route::post('/skills', [ExpertProfileController::class, 'skills'])->name('expert.profile.skills');
        Route::post('/industry', [ExpertProfileController::class, 'industry'])->name('expert.profile.industry');
    });
    // Assessment Routes
    Route::group(["prefix" => "assessment"], function () {
        Route::get('/', [AssessmentController::class, 'index'])->name('expert.assessment.index');
        Route::post('/', [AssessmentController::class, 'getQuestion'])->name('assessment.question');
        Route::post('/check', [AssessmentController::class, 'checkAnswer'])->name('assessment.check');
        Route::delete('/', [AssessmentController::class, 'retake'])->name('assessment.retake');
    });

    // Awarded Routes
    Route::group(["prefix" => "awarded"], function () {
        Route::get('/{pid}', [AwardedController::class, 'show'])->name('expert.awarded.show');
    });

    // Payment Routes
    Route::resource('payment', PaymentController::class, ['names' => 'expert.payment']);

    // Contract Routes
    Route::resource('contract', ContractController::class, ['names' => 'expert.contract']);

    // Referer Routes
    Route::resource('referer', RefererController::class, ['names' => 'expert.referer']);

    // Account Routes
    Route::post('/avatar', [AccountController::class, 'avatar'])->name('expert.account.avatar');
    Route::post('/language', [AccountController::class, 'language'])->name('expert.account.language');
    Route::post('/timezone', [AccountController::class, 'timezone'])->name('expert.account.timezone');
    Route::post('/phone', [AccountController::class, 'phone'])->name('expert.account.phone');
    Route::post('/payment', [AccountController::class, 'payment'])->name('expert.account.payment');
    Route::resource('account', AccountController::class, ['names' => 'expert.account']);

});

