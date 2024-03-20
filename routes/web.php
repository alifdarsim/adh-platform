<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CompaniesController as AdminCompaniesController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\ExpertsController;
use App\Http\Controllers\Admin\ExpertsScrapeController;
use App\Http\Controllers\Admin\HubsController;
use App\Http\Controllers\Admin\IndustryClassificationController;
use App\Http\Controllers\Admin\OverviewController as AdminOverviewController;
use App\Http\Controllers\Admin\PolicyEditor;
use App\Http\Controllers\Admin\ProjectsController as AdminProjectsController;
use App\Http\Controllers\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\OverviewController as ClientOverviewController;
use App\Http\Controllers\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use App\Http\Controllers\Client\CompanyController as ClientCompanyController;
use App\Http\Controllers\Client\PaymentController as ClientPaymentController;
use App\Http\Controllers\Client\TeamController;
use App\Http\Controllers\Cms\CmsAssessmentController;
use App\Http\Controllers\Cms\PostController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\Expert\AssessmentController;
use App\Http\Controllers\Expert\AwardedController;
use App\Http\Controllers\Expert\OverviewController as ExpertOverviewController;
use App\Http\Controllers\Expert\ProfileController as ExpertProfileController;
use App\Http\Controllers\Expert\ProjectsController as ExpertProjectsController;
use App\Http\Controllers\Expert\AccountController as ExpertAccountController;
use App\Http\Controllers\Expert\PaymentController as ExpertPaymentController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\IndustryExpertController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProjectAwardedController;
use App\Http\Controllers\ProjectInvitationController;
use App\Models\ProjectAwarded;

Route::get('/test', function () {
    return view('mail.award_project');
});

Route::get('project-invitation/{token}', [ProjectInvitationController::class, 'index'])->name('project-invitation.index');
Route::get('project-awarded/{token}', [ProjectAwardedController::class, 'index'])->name('project-awarded.index');


Route::get('/', function () {
    if (Auth::check()) {
        if (session('user_type') == 'admin' || session('user_type') == 'super admin') return redirect()->route('admin.overview.index');
        else if (session('user_type') == 'expert') return redirect()->route('expert.overview');
        else if (session('user_type') == 'client') return redirect()->route('client.overview');
        else auth()->logout();
    }
    return redirect()->route('login.index', ['type' => 'expert']);
});


// Auth Routes
Route::group(["prefix" => "auth"], function () {
    // Login and Register Routes
    Route::get('/login/{type}', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login/{type}', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
    // Social Auth Routes
    Route::get('login/social/{driver}/{user_type}/{timezone}', [SocialLoginController::class, 'redirectToDriver'])->name('login.authenticate.social');
    Route::get('callback/{driver}', [SocialLoginController::class, 'handleCallback']);
    // Register Routes
    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
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

// Policy and Terms Routes
Route::get('/privacy-policy', function () { return view('others.policy'); })->name('others.policy');
Route::get('/terms-condition', function () { return view('others.terms'); })->name('others.terms');
Route::get('/faq', function () { return view('others.faq'); })->name('others.faq');

Route::middleware(['auth', 'route.protection'])->group(function () {
    // Admin Routes
    Route::group(["prefix" => "admin"], function () {
        Route::group(["prefix" => "overview"], function () {
            Route::get('/', [AdminOverviewController::class, 'index'])->name('admin.overview.index');
            Route::get('/data', [AdminOverviewController::class, 'data'])->name('admin.overview.data');
        });
        Route::group(["prefix" => "companies"], function () {
            Route::get('/', [AdminCompaniesController::class, 'index'])->name('admin.companies.index');
            Route::post('/prefill', [AdminCompaniesController::class, 'prefill'])->name('admin.companies.prefill');
            Route::get('/create', [AdminCompaniesController::class, 'create'])->name('admin.companies.create');
            Route::get('/datatable', [AdminCompaniesController::class, 'datatable'])->name('admin.companies.datatable');
            Route::post('/store', [AdminCompaniesController::class, 'store'])->name('admin.companies.store');
            Route::put('/{id}', [AdminCompaniesController::class, 'update'])->name('admin.companies.update');
            Route::delete('/destroy/{id}', [AdminCompaniesController::class, 'destroy'])->name('admin.companies.destroy');
            Route::get('/{id}', [AdminCompaniesController::class, 'edit'])->name('admin.companies.edit');
        });
        Route::group(["prefix" => "projects"], function () {
            Route::get('/datatable', [AdminProjectsController::class, 'datatable'])->name('admin.projects.datatable');
            Route::get('/{pid}/datatable_shortlist', [AdminProjectsController::class, 'datatable_shortlist'])->name('admin.projects.datatable_shortlist');
            Route::get('/{pid}/datatable_awarding', [AdminProjectsController::class, 'datatable_awarding'])->name('admin.projects.datatable_awarding');
            Route::post('/{pid}/award-expert', [AdminProjectsController::class, 'award_expert'])->name('admin.projects.award-expert');
            Route::delete('/{pid}/{id}', [AdminProjectsController::class, 'expert_remove'])->name('admin.projects.remove-expert');

            Route::post('/add-expert', [AdminProjectsController::class, 'add_expert'])->name('admin.projects.add-expert');
            Route::get('/invite-expert/{project_id}/{expert_id}', [AdminProjectsController::class, 'invite_expert'])->name('admin.projects.invite-expert');
            Route::get('/invite-expert-all/{project_id}', [AdminProjectsController::class, 'invite_expert_all'])->name('admin.projects.invite-expert-all');
            Route::post('/respond/{pid}', [AdminProjectsController::class, 'respond'])->name('admin.projects.respond');
            Route::post('/award/{pid}', [AdminProjectsController::class, 'award'])->name('admin.projects.award');
            Route::put('/close/{pid}', [AdminProjectsController::class, 'close'])->name('admin.projects.close');
            Route::put('/reset/{pid}', [AdminProjectsController::class, 'reset'])->name('admin.projects.reset');
            Route::put('/payment/{pid}', [AdminProjectsController::class, 'payment'])->name('admin.projects.payment');
            Route::post('/payment/{pid}', [AdminProjectsController::class, 'payment_amount'])->name('admin.projects.payment_amount');
            Route::put('/start/{pid}', [AdminProjectsController::class, 'start'])->name('admin.projects.start');

            // show project
            Route::get('/', [AdminProjectsController::class, 'index'])->name('admin.projects.index');
            Route::get('/create', [AdminProjectsController::class, 'create'])->name('admin.projects.create');
            Route::post('/', [AdminProjectsController::class, 'store'])->name('admin.projects.store');
            Route::get('/{pid}', [AdminProjectsController::class, 'show'])->name('admin.projects.show');
            Route::get('/{pid}/edit', [AdminProjectsController::class, 'edit'])->name('admin.projects.edit');
            Route::patch('/{id}', [AdminProjectsController::class, 'update'])->name('admin.projects.update');
            Route::delete('/{id}', [AdminProjectsController::class, 'destroy'])->name('admin.projects.destroy');
        });
        Route::group(["prefix" => "experts"], function () {
            Route::get('/', [ExpertsController::class, 'index'])->name('admin.experts.index');
            Route::delete('/{id}', [ExpertsController::class, 'destroy'])->name('admin.experts.destroy');
            Route::get('/datatable', [ExpertsController::class, 'datatable'])->name('admin.experts.datatable');
            Route::post('/contact', [ExpertsController::class, 'set_contact'])->name('admin.experts.set-contact');
            Route::post('/industry', [ExpertsController::class, 'industry'])->name('admin.experts.industry');
        });
        Route::group(["prefix" => "expert_scrape"], function () {
            Route::get('/datatable', [ExpertsScrapeController::class, 'datatable'])->name('admin.expert_scrape.datatable');
            Route::get('/scrape/{id}', [ExpertsScrapeController::class, 'scrape'])->name('admin.expert_scrape.scrape');
            Route::get('/processed/{id}', [ExpertsScrapeController::class, 'processed'])->name('admin.expert_scrape.processed');
            Route::get('/', [ExpertsScrapeController::class, 'index'])->name('admin.expert_scrape.index');
            Route::post('/', [ExpertsScrapeController::class, 'store'])->name('admin.expert_scrape.store');
        });
        Route::group(["prefix" => "users"], function () {
            Route::get('/', [UsersController::class, 'index'])->name('admin.users.index');
            Route::get('/datatable', [UsersController::class, 'datatable'])->name('admin.users.datatable');
            Route::get('/{id}', [UsersController::class, 'userShow'])->name('admin.users.show');
            Route::post('/{id}', [UsersController::class, 'userUpdate'])->name('admin.users.update');
            Route::delete('/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
        });
        Route::group(["prefix" => "admins"], function () {
            Route::get('/', [AdminsController::class, 'index'])->name('admin.admins.index');
            Route::get('/create', [AdminsController::class, 'create'])->name('admin.admins.create');
            Route::put('/edit', [AdminsController::class, 'edit'])->name('admin.admins.edit');
            Route::post('/create', [AdminsController::class, 'store'])->name('admin.admins.store');
            Route::get('/datatable', [AdminsController::class, 'datatable'])->name('admin.admins.datatable');
            Route::get('/{id}', [AdminsController::class, 'userShow'])->name('admin.admins.show');
            Route::post('/{id}', [AdminsController::class, 'userUpdate'])->name('admin.admins.update');
            Route::delete('/{id}', [AdminsController::class, 'destroy'])->name('admin.admins.destroy');
        });
        Route::group(["prefix" => "subscriptions"], function () {
            Route::get('/subscription', [SubscriptionController::class, 'index'])->name('admin.subscription');
            Route::get('/subscription/list', [SubscriptionController::class, 'index'])->name('admin.subscription.list');
            Route::get('/subscription/analytics', [SubscriptionController::class, 'index'])->name('admin.subscription.analytics');
        });
        // CMS Routes
        Route::group(["prefix" => "cms"], function () {
            Route::singleton('/quiz', CmsAssessmentController::class)->creatable();
            Route::group(["prefix" => "post"], function () {
                Route::get('/', [PostController::class, 'index'])->name('admin.post.index');
                Route::get('/create', [PostController::class, 'create'])->name('admin.post.create');
                Route::get('/edit/{id}', [PostController::class, 'edit'])->name('admin.post.edit');
                Route::delete('/', [PostController::class, 'destroy'])->name('admin.post.destroy');
                Route::post('/', [PostController::class, 'store'])->name('admin.post.store');
                Route::post('/{id}', [PostController::class, 'update'])->name('admin.post.update');
                Route::get('/datatable', [PostController::class, 'datatable'])->name('admin.post.datatable');
                Route::get('/quick_view', [PostController::class, 'quick_view'])->name('admin.post.quick_view');
            });
        });
        Route::group(["prefix" => "editor"], function () {
            Route::get('/privacy-policy', [PolicyEditor::class, 'privacy'])->name('admin.editor.privacy');
            Route::get('/terms-condition', [PolicyEditor::class, 'terms_conditions'])->name('admin.editor.terms_conditions');
            Route::get('/faq', [PolicyEditor::class, 'faq'])->name('admin.editor.faq');
            Route::put('/update/{type}', [PolicyEditor::class, 'update'])->name('admin.editor.update');
        });
        Route::group(["prefix" => "account"], function () {
            Route::get('/', [AdminAccountController::class, 'index'])->name('admin.account.index');
            Route::get('/security', [AdminAccountController::class, 'security'])->name('admin.account.security');
            Route::get('/notification', [AdminAccountController::class, 'notification'])->name('admin.account.notification');
            Route::get('/activity', [AdminAccountController::class, 'activity'])->name('admin.account.activity');
        });
        Route::group(["prefix" => "payment"], function () {
            Route::get('/', [AdminPaymentController::class, 'index'])->name('admin.payment.index');
            Route::get('/datatable', [AdminPaymentController::class, 'datatable'])->name('admin.payment.datatable');
            Route::post('/confirm', [AdminPaymentController::class, 'confirm'])->name('admin.payment.confirm');
            Route::post('/release', [AdminPaymentController::class, 'release'])->name('admin.payment.release');
        });
        // Hub Routes
        Route::resource('hubs', HubsController::class, ['names' => 'admin.hubs'])->withDatatable();
        Route::get('contract/{type}', [ContractController::class, 'default'])->name('admin.contract.default');
        Route::resource('contracts', ContractController::class, ['names' => 'admin.contract']);
        Route::resource('industry_classification', IndustryClassificationController::class, ['names' => 'admin.industry_classification'])->withDatatable();
    });

    // Client Routes
    Route::group(["prefix" => "client"], function () {
        // Overview Routes
        Route::get('/overview', [ClientOverviewController::class, 'index'])->name('client.overview');

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

    // Expert Routes
    Route::group(["prefix" => "expert"], function () {
        // Overview Routes
        Route::get('/overview', [ExpertOverviewController::class, 'index'])->name('expert.overview');
        // Project Routes
        Route::group(["prefix" => "projects"], function () {
            Route::get('/', [ExpertProjectsController::class, 'index'])->name('expert.projects.index');
            Route::get('/datatable', [ExpertProjectsController::class, 'datatable'])->name('expert.projects.datatable');
            Route::post('/respond', [ExpertProjectsController::class, 'respond'])->name('expert.projects.respond');
            Route::get('/{pid}', [ExpertProjectsController::class, 'show'])->name('expert.projects.show');
            Route::post('/accept', [ExpertProjectsController::class, 'accept'])->name('expert.projects.accept');
            Route::post('/report', [ExpertProjectsController::class, 'report'])->name('expert.projects.report');
            Route::post('/answer-enquiries', [ExpertProjectsController::class, 'answer_enquiries'])->name('expert.projects.answer-enquiries');
        });
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
        Route::group(["prefix" => "account"], function () {
            Route::get('/', [ExpertAccountController::class, 'index'])->name('expert.account.index');
            Route::get('/security', [ExpertAccountController::class, 'security'])->name('expert.account.security');
            Route::get('/notification', [ExpertAccountController::class, 'notification'])->name('expert.account.notification');
            Route::get('/activity', [ExpertAccountController::class, 'activity'])->name('expert.account.activity');
            Route::get('/payment', [ExpertAccountController::class, 'payment'])->name('expert.account.payment');
        });
        Route::group(["prefix" => "payment"], function () {
            Route::get('/', [ExpertPaymentController::class, 'index'])->name('expert.payment.index');
            Route::get('/datatable', [ExpertPaymentController::class, 'datatable'])->name('expert.payment.datatable');
        });

    });

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

    Route::post('/contract/upload/{pid}/{type}/{status}', [ContractController::class, 'upload'])->name('contract.upload_signed');
});


