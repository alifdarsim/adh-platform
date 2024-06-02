<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\ExpertImportController;
use App\Http\Controllers\Admin\ExpertsController;
use App\Http\Controllers\Admin\HubsController;
use App\Http\Controllers\Admin\IndustryClassificationController;
use App\Http\Controllers\Admin\OverviewController as AdminOverviewController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\TermsPolicyEditor;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\RefererController;
use App\Http\Controllers\Admin\UsersClientController;
use App\Http\Controllers\Admin\UsersExpertController;
use App\Http\Controllers\Assessment\AssessmentEditorController;
use App\Http\Controllers\ContractTemplateController;
use App\Http\Controllers\EmailViewerController;
use App\Http\Controllers\ExpertPortalController;

Route::middleware(['auth', 'route.protection', 'set.locale'])->group(function () {

    Route::get('/email-view/{pid}', [EmailViewerController::class, 'index'])->name('admin.email_project_view');

    Route::group(["prefix" => "overview"], function () {
        Route::get('/', [AdminOverviewController::class, 'index'])->name('admin.overview.index');
        Route::get('/data', [AdminOverviewController::class, 'data'])->name('admin.overview.data');
    });

    Route::group(["prefix" => "projects"], function () {
        Route::get('/datatable', [ProjectsController::class, 'datatable'])->name('admin.projects.datatable');
        Route::get('/{pid}/datatable-expert', [ProjectsController::class, 'datatable_expert'])->name('admin.projects.datatable_expert');
        Route::post('/{pid}/award-expert', [ProjectsController::class, 'award_expert'])->name('admin.projects.award-expert');
        Route::post('/force-accept/{project_id}/{expert_id}', [ProjectsController::class, 'force_accept'])->name('admin.projects.force-accept');
        Route::post('/award/{project_id}/{expert_id}', [ProjectsController::class, 'award'])->name('admin.projects.award');
        Route::post('/payment/{project_id}/{expert_id}', [ProjectsController::class, 'setPayment'])->name('admin.projects.set-payment');

        Route::delete('/{pid}/{id}', [ProjectsController::class, 'expert_remove'])->name('admin.projects.remove-expert');

        Route::post('/add-expert', [ProjectsController::class, 'add_expert'])->name('admin.projects.add-expert');
        Route::get('/invite-expert/{project_id}/{expert_id}', [ProjectsController::class, 'invite_expert'])->name('admin.projects.invite-expert');
        Route::get('/set-complete/{project_id}/{expert_id}', [ProjectsController::class, 'set_complete'])->name('admin.projects.set-completed');
        Route::get('/invite-expert-all/{project_id}', [ProjectsController::class, 'invite_expert_all'])->name('admin.projects.invite-expert-all');
        Route::post('/respond/{pid}', [ProjectsController::class, 'respond'])->name('admin.projects.respond');
        Route::put('/close/{pid}', [ProjectsController::class, 'close'])->name('admin.projects.close');
        Route::put('/reopen/{pid}', [ProjectsController::class, 'reopen'])->name('admin.projects.reopen');
        Route::put('/remove/{pid}', [ProjectsController::class, 'remove'])->name('admin.projects.remove');
        Route::put('/reset/{pid}', [ProjectsController::class, 'reset'])->name('admin.projects.reset');
        Route::put('/payment/{pid}', [ProjectsController::class, 'payment'])->name('admin.projects.payment');
        Route::post('/payment/{pid}', [ProjectsController::class, 'payment_amount'])->name('admin.projects.payment_amount');
        Route::put('/start/{pid}', [ProjectsController::class, 'start'])->name('admin.projects.start');

        // show project
        Route::get('/', [ProjectsController::class, 'index'])->name('admin.projects.index');
        Route::get('/create', [ProjectsController::class, 'create'])->name('admin.projects.create');
        Route::post('/', [ProjectsController::class, 'store'])->name('admin.projects.store');
        Route::get('/{pid}', [ProjectsController::class, 'show'])->name('admin.projects.show');
        Route::get('/edit/{pid}', [ProjectsController::class, 'edit'])->name('admin.projects.edit');
        Route::patch('/{id}', [ProjectsController::class, 'update'])->name('admin.projects.update');
        Route::delete('/{id}', [ProjectsController::class, 'destroy'])->name('admin.projects.destroy');
    });

    Route::group(["prefix" => "experts"], function () {
        Route::get('/', [ExpertsController::class, 'index'])->name('admin.experts.index');
        Route::delete('/{id}', [ExpertsController::class, 'destroy'])->name('admin.experts.destroy');
        Route::get('/datatable', [ExpertsController::class, 'datatable'])->name('admin.experts.datatable');
        Route::post('/contact', [ExpertsController::class, 'set_contact'])->name('admin.experts.set-contact');
        Route::post('/industry', [ExpertsController::class, 'industry'])->name('admin.experts.industry');
    });

    Route::group(["prefix" => "payment"], function () {
        Route::get('/', [PaymentController::class, 'index'])->name('admin.payment.index');
        Route::get('/datatable', [PaymentController::class, 'datatable'])->name('admin.payment.datatable');
        Route::post('/confirm', [PaymentController::class, 'confirm'])->name('admin.payment.confirm');
        Route::post('/release', [PaymentController::class, 'release'])->name('admin.payment.release');
    });

    // Contract Routes
    Route::post('contract/change-signature', [ContractController::class, 'changeDefaultSignature'])->name('admin.contract.change_signature');
    Route::resource('contract', ContractController::class, ['names' => 'admin.contract']);
    // Contract Template Routes
    Route::resource('contract-template', ContractTemplateController::class, ['names' => 'admin.contract-template']);
    // Companies Routes
    Route::post('/prefill', [CompaniesController::class, 'prefill'])->name('admin.companies.prefill');
    Route::resource('companies', CompaniesController::class, ['names' => 'admin.companies']);

    // Admin Routes
    Route::resource('admins', AdminsController::class, ['names' => 'admin.admins']);
    // User Client Routes
    Route::resource('users-client', UsersClientController::class, ['names' => 'admin.users-client']);
    // User Expert Routes
    Route::resource('users-expert', UsersExpertController::class, ['names' => 'admin.users-expert']);
    // User Expert Import Routes
    Route::post('expert-import/{id}/re-scrape', [ExpertImportController::class, 'reScrape'])->name('admin.expert-import.re-scrape');
    Route::post('expert-import/{id}/set-email', [ExpertImportController::class, 'setEmail'])->name('admin.expert-import.set-email');
    Route::post('expert-import/{id}/set-industry', [ExpertImportController::class, 'setIndustryClassification'])->name('admin.expert-import.set-industry');
    Route::resource('expert-import', ExpertImportController::class, ['names' => 'admin.expert-import']);

    // Expert Portal Routes
    Route::get('/datatableOngoing/{id}', [ExpertPortalController::class, 'datatableOngoing'])->name('admin.expert-portal.datatable_ongoing');
    Route::get('/datatableComplete/{id}', [ExpertPortalController::class, 'datatableComplete'])->name('admin.expert-portal.datatable_complete');
    Route::get('/import/{linkedin}', [ExpertPortalController::class, 'viewFromImport'])->name('admin.expert-portal.view-from-import');
//    Route::get('/registered/{linkedin}', [ExpertPortalController::class, 'viewFromRegistered'])->name('admin.expert-portal.view-from-registered');
    Route::resource('expert-portal', ExpertPortalController::class, ['names' => 'admin.expert-portal']);

    // Hub Routes
    Route::resource('hubs', HubsController::class, ['names' => 'admin.hubs'])->withDatatable();
    // Industry Classification Routes
    Route::resource('industry_classification', IndustryClassificationController::class, ['names' => 'admin.industry_classification'])->withDatatable();

    // Policy Editor Routes
    Route::resource('terms-policy', TermsPolicyEditor::class, ['names' => 'admin.terms-policy']);
    // Assessment Routes
    Route::singleton('assessment', AssessmentEditorController::class, ['names' => 'admin.assessment'])->creatable();


    // Referer Routes
    Route::resource('referer', RefererController::class, ['names' => 'admin.referer']);
    // Account Routes
    Route::post('/avatar', [AccountController::class, 'avatar'])->name('admin.account.avatar');
    Route::post('/language', [AccountController::class, 'language'])->name('admin.account.language');
    Route::post('/timezone', [AccountController::class, 'timezone'])->name('admin.account.timezone');
    Route::resource('account', AccountController::class, ['names' => 'admin.account']);
});


