<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\ExpertsController;
use App\Http\Controllers\Admin\ExpertsScrapeController;
use App\Http\Controllers\Admin\HubsController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Cms\AuthorsController;
use App\Http\Controllers\Cms\CmsAssessmentController;
use App\Http\Controllers\Cms\PostController;
use App\Http\Controllers\Cms\TagsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\Deal\DealManagementController;
use App\Http\Controllers\Expert\AwardedController;
use App\Http\Controllers\Expert\OverviewController as ExpertOverviewController;
use App\Http\Controllers\Client\OverviewController as ClientOverviewController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;

use App\Http\Controllers\Admin\OverviewController as AdminOverviewController;
use App\Http\Controllers\Admin\CompaniesController as AdminCompaniesController;
use App\Http\Controllers\Admin\ProjectsController as AdminProjectsController;
use App\Http\Controllers\Expert\ProjectsController as ExpertProjectsController;
use App\Http\Controllers\ExpertCompletionController;
use App\Http\Controllers\ExpertDataController;
use App\Http\Controllers\ExpertProfileController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\ManageProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectInvitation;

Route::get('/test', function () {
    return view('mail.project_invitation');
});

Route::group(["prefix" => "project-invitation"], function () {
    Route::get('/{token}', [ProjectInvitation::class, 'index'])->name('project-invitation.index');
});

Route::get('/', function () {
    if (Auth::check()) {
        if (str_contains(Auth::user()->getRoleNames()[0], 'admin')) return redirect()->route('admin.companies.index');
        if (session('user_type') == 'expert') return redirect()->route('expert.overview');
        if (session('user_type') == 'client') return redirect()->route('client.overview');
    }
    return redirect()->route('login', ['type' => 'expert']);
});

// Auth Routes
Route::group(["prefix" => "auth"], function () {
    // Login and Register Routes
    Route::get('/login/{type}', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');

    // Social Auth Routes
    Route::get('login/social/{driver}/{user_type}', [SocialLoginController::class, 'redirectToDriver'])->name('login.authenticate.social');
    Route::get('callback/{driver}', [SocialLoginController::class, 'handleCallback']);

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/forgot-password', function () { return view('auth.register'); })->name('forgot-password');
});

// Admin Invitation Routes
Route::get('/invitation/{token}', [AdminsController::class, 'invitation'])->name('admin.invitation');
Route::post('/invitation', [AdminsController::class, 'invitationPassword'])->name('admin.password-invitation');
Route::get('/account-confirmation/{token}', [RegisterController::class, 'confirm'])->name('register.confirm');
Route::get('/account-removal/{token}', [RegisterController::class, 'remove_account'])->name('register.remove_account');

// Policy and Terms Routes
Route::get('/privacy-policy', function () { return view('others.policy'); })->name('others.policy');
Route::get('/terms-condition', function () { return view('others.terms'); })->name('others.terms');
Route::get('/faq', function () { return view('others.faq'); })->name('others.faq');

Route::middleware(['auth', 'route.protection'])->group(function () {
    // Admin Routes
    Route::group(["prefix" => "admin"], function () {
        Route::get('/overview', [AdminOverviewController::class, 'index'])->name('admin.overview');
        Route::group(["prefix" => "companies"], function () {
            Route::get('/', [AdminCompaniesController::class, 'index'])->name('admin.companies.index');
            Route::post('/prefill', [AdminCompaniesController::class, 'prefill'])->name('admin.companies.prefill');
            Route::get('/create', [AdminCompaniesController::class, 'create'])->name('admin.companies.create');
            Route::get('/datatable', [AdminCompaniesController::class, 'datatable'])->name('admin.companies.datatable');
            Route::post('/store', [AdminCompaniesController::class, 'store'])->name('admin.companies.store');
            Route::delete('/destroy/{id}', [AdminCompaniesController::class, 'destroy'])->name('admin.companies.destroy');
            Route::get('/{id}', [AdminCompaniesController::class, 'show'])->name('admin.companies.show');
        });
        Route::group(["prefix" => "projects"], function () {
            Route::get('/datatable', [AdminProjectsController::class, 'datatable'])->name('admin.projects.datatable');
            Route::get('/{pid}/datatable_expert', [AdminProjectsController::class, 'datatable_expert'])->name('admin.projects.datatable_expert');
            Route::get('/{pid}/datatable_awarding', [AdminProjectsController::class, 'datatable_awarding'])->name('admin.projects.datatable_awarding');
            Route::post('/{pid}/award-expert', [AdminProjectsController::class, 'award_expert'])->name('admin.projects.award-expert');
            Route::delete('/{pid}/{id}', [AdminProjectsController::class, 'expert_remove'])->name('admin.projects.remove-expert');

            Route::post('/add-expert', [AdminProjectsController::class, 'add_expert'])->name('admin.projects.add-expert');
            Route::get('/invite-expert/{id}', [AdminProjectsController::class, 'invite_expert'])->name('admin.projects.invite-expert');
            Route::post('/respond/{pid}', [AdminProjectsController::class, 'respond'])->name('admin.projects.respond');

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
            Route::delete('/{id}', [UsersController::class, 'userDestroy'])->name('admin.users.destroy');
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
            Route::singleton('/post', PostController::class)->creatable();
            Route::get('/post/quick_view', [PostController::class, 'quick_view'])->name('post.quick_view');
            Route::singleton('/tags', TagsController::class)->creatable();
            Route::singleton('/authors', AuthorsController::class)->creatable();
        });

        // Hub Routes
        Route::resource('hubs', HubsController::class, ['names' => 'admin.hubs'])->withDatatable();
    });

    // Client Routes
    Route::group(["prefix" => "client"], function () {
        // Overview Routes
        Route::get('/overview', [ClientOverviewController::class, 'index'])->name('client.overview');
        // Projects Routes
        Route::get('/projects', [ClientProjectController::class, 'index'])->name('client.projects.index');
        Route::get('/projects/create', [ClientProjectController::class, 'create'])->name('client.projects.create');
        Route::get('/projects/datatable', [ClientProjectController::class, 'datatable'])->name('client.projects.datatable');
        Route::post('/projects/store', [ClientProjectController::class, 'store'])->name('client.projects.store');
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
            Route::get('/', [ExpertProfileController::class, 'index'])->name('expert.profile');
            Route::get('/security', [ExpertProfileController::class, 'security'])->name('expert.profile.security');
            Route::get('/notification', [ExpertProfileController::class, 'notification'])->name('expert.profile.notification');
            Route::get('/activity', [ExpertProfileController::class, 'activity'])->name('expert.profile.activity');
            Route::get('/social', [ExpertProfileController::class, 'social'])->name('expert.profile.social');
            Route::get('/data', [ExpertDataController::class, 'index'])->name('expert.profile.data');
            Route::post('/update', [ExpertDataController::class, 'update'])->name('expert.profile.update');
            Route::post('/job-add', [ExpertDataController::class, 'jobAdd'])->name('expert.profile.job-add');
            Route::delete('/job-remove', [ExpertDataController::class, 'jobRemove'])->name('expert.profile.job-remove');
        });
        // Profile Completion Routes
        Route::group(["prefix" => "profile-completion"], function () {
            // Profile Completion Routes
            Route::get('/', [ExpertCompletionController::class, 'index'])->name('expert.profile-completion');
            Route::post('/linkedin', [ExpertCompletionController::class, 'linkedin'])->name('expert.profile-completion.linkedin');
            Route::post('/cv', [ExpertCompletionController::class, 'cv'])->name('expert.profile-completion.cv');
            Route::post('/skills', [ExpertCompletionController::class, 'skills'])->name('expert.profile-completion.skills');
        });
        // Assessment Routes
        Route::group(["prefix" => "assessment"], function () {
            Route::get('/', [AssessmentController::class, 'index'])->name('expert.assessment');
            Route::post('/', [AssessmentController::class, 'getQuestion'])->name('assessment.question');
            Route::post('/check', [AssessmentController::class, 'checkAnswer'])->name('assessment.check');
            Route::delete('/', [AssessmentController::class, 'retake'])->name('assessment.retake');
        });
        // Awarded Routes
        Route::group(["prefix" => "awarded"], function () {
            Route::get('/{pid}', [AwardedController::class, 'show'])->name('expert.awarded.show');
        });
    });

    // Awarded Project Route
    Route::post('/project/uploadEvent', [AwardedController::class, 'uploadEvent'])->name('expert.awarded.upload');
    Route::post('/project/downloadEvent', [AwardedController::class, 'downloadEvent'])->name('expert.awarded.download');
    Route::post('/project/deleteEvent', [AwardedController::class, 'deleteEvent'])->name('expert.awarded.delete');
    Route::post('/project/updateEvent', [AwardedController::class, 'updateEvent'])->name('expert.awarded.update');
    Route::get('/chat/{pid}', [ChatController::class, 'getMessage'])->name('expert.chat.get');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('expert.chat.send');

    // Deal Management Routes
    Route::resource('deal_management', DealManagementController::class);
    Route::post('/deal_management/approve', [DealManagementController::class, 'approve'])->name('deal_management.approve');
    Route::post('/deal_management/archive', [DealManagementController::class, 'archive'])->name('deal_management.archive');
    Route::post('/deal_management/remove', [DealManagementController::class, 'remove'])->name('deal_management.remove');
    Route::post('/deal_management/reject', [DealManagementController::class, 'reject'])->name('deal_management.reject');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/upload', [ProfileController::class, 'uploadImage'])->name('profile.upload');
    Route::get('/profile/activity', [ProfileController::class, 'activity'])->name('profile.activity');
    Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::get('/profile/social', [ProfileController::class, 'social'])->name('profile.social');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/companies/search', [CompaniesController::class, 'search'])->name('companies.search');
    Route::get('/companies/types', [CompaniesController::class, 'getTypes'])->name('companies.types');
    Route::get('/hubs', [HubController::class, 'index'])->name('hubs');
    Route::get('/industries', [IndustryController::class, 'index'])->name('industries.index');
    Route::post('/industries', [IndustryController::class, 'search'])->name('industries.search');
    Route::get('/companies/{id}', [CompaniesController::class, 'get'])->name('companies.get');
    Route::get('/address/cities/search', [AddressController::class, 'cities_search'])->name('cities.search');
    Route::get('/address/states/search', [AddressController::class, 'states_search'])->name('states.search');
    Route::get('/address/countries', [AddressController::class, 'countries'])->name('countries.index');
    Route::get('/address/countries/search', [AddressController::class, 'countries_search'])->name('countries.search');
});

