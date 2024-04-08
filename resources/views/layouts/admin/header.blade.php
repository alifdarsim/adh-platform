<div class="nk-header nk-header-fixed is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="{{route('admin.overview.index')}}" class="logo-link">
                    <img class="logo-light logo-img tw-h-[32px]" src="/images/asiadealhub.png" srcset="/images/asiadealhub.png" alt="logo">
                    <img class="logo-dark logo-img" src="/images/asiadealhub.png" srcset="/images/asiadealhub.png" alt="logo-dark">
                    <span class="nio-version tw-text-slate-300">ADMIN DASHBOARD</span>
                </a>
            </div>
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                            <div class="quick-icon border border-light">
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
{{--                                <li>--}}
{{--                                    <a href="#" class="language-item">--}}
{{--                                        <img src="/images/flags/spanish.png" alt="" class="language-flag">--}}
{{--                                        <span class="language-name">Español</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#" class="language-item">--}}
{{--                                        <img src="/images/flags/french.png" alt="" class="language-flag">--}}
{{--                                        <span class="language-name">Français</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <a href="#" class="language-item">--}}
{{--                                        <img src="/images/flags/turkey.png" alt="" class="language-flag">--}}
{{--                                        <span class="language-name">Türkçe</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </li><!-- .dropdown -->
{{--                    <li class="dropdown notification-dropdown me-n1">--}}
{{--                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">--}}
{{--                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">--}}
{{--                            <div class="dropdown-head">--}}
{{--                                <span class="sub-title nk-dropdown-title">Notifications</span>--}}
{{--                                <a href="#">Mark All as Read</a>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown-body">--}}
{{--                                <div class="nk-notification">--}}
{{--                                    <div class="nk-notification-item dropdown-inner">--}}
{{--                                        <div class="nk-notification-icon">--}}
{{--                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>--}}
{{--                                        </div>--}}
{{--                                        <div class="nk-notification-content">--}}
{{--                                            <div class="nk-notification-text">- <span></span></div>--}}
{{--                                            <div class="nk-notification-time">- hrs ago</div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="dropdown-foot center">--}}
{{--                                <a href="#">View All</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li><!-- .dropdown -->--}}

                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-md-block">
                                    <div class="user-status text-capitalize">{{auth()->user()->getRoleNames()[0]}}</div>
                                    <div class="user-name dropdown-indicator">{{auth()->user()->name}}</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{auth()->user()->name}}</span>
                                        <span class="sub-text">{{auth()->user()->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{route('admin.account.index')}}"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                    <li><a href="{{route('admin.account.activity')}}"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                    <li class="d-flex justify-between">
                                        <a><em class="icon ni ni-moon"></em><span>Dark Mode</span></a>
                                        <div class="custom-control custom-switch justify-center tw-mt-2">
                                            <input  id="dark-switch" type="checkbox" class="custom-control-input">
                                            <label class="custom-control-label" for="dark-switch"></label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="{{route('logout', ['type' => 'expert'])}}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
@push('scripts')
    <script>
        if (localStorage.getItem('dark')) {
            $('#dark-switch').prop('checked', true);
        }

        $('#dark-switch').on('change', function () {
            console.log(this.checked);
            if (this.checked) {
                localStorage.setItem('dark', 'true');
                $('.nk-body').addClass('dark-mode');
            }
            else {
                localStorage.removeItem('dark');
                $('.nk-body').removeClass('dark-mode');
            }
        });

    </script>
@endpush
