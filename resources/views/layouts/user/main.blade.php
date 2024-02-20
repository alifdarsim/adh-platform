<!DOCTYPE html>
<html lang="en" class="js">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta name="author" content="AsiaDealHub">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Connecting Asia Through Digital Deal Matchmaking.We Made It Faster and Easier For You.">
    <meta name="keywords"
          content="B2B Matching, Carbon neutral , R&D, AI, M&A, Partnership, Procurement, Sourcing, and Cross-border">
    <meta name="author" content="Asia Deal Hub">
    <meta name="website" content="https://asiadealhub.com">
    <meta name="email" content="support@dealhub.com">
    <meta name="version" content="1.0.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/images/favicon.png">
    <!-- Page Title  -->
    <title>AsiaDealHub Dashboard</title>
    <link href="https://ka-f.fontawesome.com/releases/v6.4.2/css/pro.min.css" rel="stylesheet">
    @stack('stylesheet')
    @vite('resources/scss/user/app.scss')
    @vite('resources/css/app.css')
    <link id="skin-theme" rel="stylesheet" href="/assets/css/red.css?ver=3.2.3">
</head>

<body class="nk-body bg-lighter ui-shady">
<div class="nk-app-root">
    <div class="nk-wrap ">
        <div class="nk-header nk-header-fluid nk-header-fixed is-dark">
            <div class="container-xl wide-lg">
                <div class="nk-header-wrap">
                    <div class="nk-menu-trigger me-sm-2 d-lg-none">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-header-brand">
                        <a href="{{session('user_type') == 'client' ? route('client.overview') : route('expert.overview')}}" class="logo-link">
                            <img class="logo-light logo-img tw-h-[32px]" src="/images/asiadealhub.png" srcset="/images/asiadealhub.png" alt="logo">
                            <img class="logo-dark logo-img" src="/images/asiadealhub.png" srcset="/images/asiadealhub.png" alt="logo-dark">
                            <span class="nio-version tw-text-slate-300">
                                {{session('user_type') == 'client' ? 'CLIENT' : 'EXPERT'}}
                            </span>
                        </a>
                    </div>
                    @if (session('user_type') == 'client')
                        @include('layouts.user.client_header')
                    @else
                        @include('layouts.user.expert_header')
                    @endif
                    <div class="nk-header-tools">
                        <ul class="nk-quick-nav">
                            <li class="dropdown notification-dropdown">
                                <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                    <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                                    <div class="dropdown-head">
                                        <span class="sub-title nk-dropdown-title">Notifications</span>
                                        <a href="#">Mark All as Read</a>
                                    </div>
                                    <div class="dropdown-body">
                                        <div class="nk-notification">
                                            <div class="nk-notification-item dropdown-inner">
                                                <div class="nk-notification-icon">
                                                    <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                </div>
                                                <div class="nk-notification-content">
                                                    <div class="nk-notification-text">Notification not implemented yet</div>
                                                    <div class="nk-notification-time">0 hrs ago</div>
                                                </div>
                                            </div>
{{--                                            <div class="nk-notification-item dropdown-inner">--}}
{{--                                                <div class="nk-notification-icon">--}}
{{--                                                    <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>--}}
{{--                                                </div>--}}
{{--                                                <div class="nk-notification-content">--}}
{{--                                                    <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>--}}
{{--                                                    <div class="nk-notification-time">2 hrs ago</div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div><!-- .nk-notification -->
                                    </div><!-- .nk-dropdown-body -->
                                    <div class="dropdown-foot center">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown language-dropdown d-none d-sm-flex me-n1">
                                <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                    <div class="quick-icon">
                                        <img class="icon" src="/images/flags/english-sq.png" alt="">
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                                    <ul class="language-list">
                                        <li>
                                            <a href="#" class="language-item">
                                                <img src="/images/flags/english.png" alt="" class="language-flag">
                                                <span class="language-name">English</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="dropdown user-dropdown order-sm-first">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <div class="user-toggle">
                                        <div class="user-avatar sm">
                                            <img src="{{auth()->user()->avatar()}}" alt="">
                                        </div>
                                        <div class="user-info d-none d-xl-block">
                                            <div class="user-status user-status-unverified">{{session('user_type') == 'client' ? 'Client' : 'Expert'}}</div>
                                            <div class="user-name dropdown-indicator fs-13px">{{auth()->user()->name ?? 'Not Set'}}</div>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1 is-light">
                                    <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                        <div class="user-card">
                                            <div class="user-avatar">
                                                <img src="{{auth()->user()->avatar()}}" alt="">
                                            </div>
                                            <div class="user-info">
                                                <span class="lead-text">{{auth()->user()->name ?? 'Not Set'}}</span>
                                                <span class="sub-text">{{auth()->user()->email}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-inner">
                                        <ul class="link-list">
                                            <li><a href="{{route('expert.account.index')}}"><em class="icon ni ni-user-alt"></em><span>Account Setting</span></a></li>
                                            <li><a href="{{route('expert.account.activity')}}"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                            <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="dropdown-inner">
                                        <ul class="link-list">
                                            <li><a href="{{route('logout', ['type' => session('user_type')]) }}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-content nk-content-lg nk-content-fluid">
            <div class="container-xl wide-lg">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.user.footer')
    </div>
</div>

<script src="/assets/js/bundle.js?ver=3.2.2"></script>
<script src="/assets/js/scripts.js?ver=3.2.2"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
@stack('scripts')
</body>

</html>
