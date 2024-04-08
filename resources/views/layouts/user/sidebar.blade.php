<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{session('user_type') == 'client' ? route('client.overview') : route('expert.overview')}}" class="logo-link">
                <img class="logo-light logo-img tw-h-[32px]" src="/images/asiadealhub.png" srcset="/images/asiadealhub.png" alt="logo">
                <img class="logo-dark logo-img" src="/images/asiadealhub.png" srcset="/images/asiadealhub.png" alt="logo-dark">
                <span class="nio-version tw-text-slate-300">EXPERT DASHBOARD</span>
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
{{--                <ul class="nk-menu nk-menu-main">--}}
{{--                    <li class="nk-menu-item">--}}
{{--                        <a href="{{route('client.overview')}}" class="nk-menu-link">--}}
{{--                            <span class="nk-menu-text">Overview</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nk-menu-item has-sub">--}}
{{--                        <a href="#" class="nk-menu-link nk-menu-toggle">--}}
{{--                            <span class="nk-menu-icon"><i class="fa-regular fa-box-dollar fs-5"></i></span>--}}
{{--                            <span class="nk-menu-text">Projects</span>--}}
{{--                        </a>--}}
{{--                        <ul class="nk-menu-sub">--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="{{route('client.projects.index')}}" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-text">Manage Projects</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="{{route('client.projects.create')}}" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-text">Create Projects</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="nk-menu-item">--}}
{{--                        <a href="{{route('client.payment.index')}}" class="nk-menu-link">--}}
{{--                            <span class="nk-menu-text">Payment</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nk-menu-item has-sub">--}}
{{--                        <a href="#" class="nk-menu-link nk-menu-toggle">--}}
{{--                            <span class="nk-menu-icon"><i class="fa-regular fa-box-dollar fs-5"></i></span>--}}
{{--                            <span class="nk-menu-text">COMPANY</span>--}}
{{--                        </a>--}}
{{--                        <ul class="nk-menu-sub">--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="{{route('client.company.index')}}" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-text">My Company</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li class="nk-menu-item">--}}
{{--                                <a href="{{route('client.company.create')}}" class="nk-menu-link">--}}
{{--                                    <span class="nk-menu-text">Create Company</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Management</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{route('expert.overview')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fa-regular fa-chart-tree-map fs-5"></i></span>
                            <span class="nk-menu-text">Overview</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{route('expert.projects.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fa-regular fa-building fs-5"></i></span>
                            <span class="nk-menu-text">Manage Projects</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fa-regular fa-building-magnifying-glass fs-5"></i></span>
                            <span class="nk-menu-text">Public Projects</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{route('admin.payment.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fa-regular fa-coin fs-5"></i></span>
                            <span class="nk-menu-text">Payments</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{route('admin.expert_scrape.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fa-regular fa-users fs-5"></i></span>
                            <span class="nk-menu-text">Company</span>
                        </a>
                    </li>
                    <section>
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Misc</h6>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{route('admin.account.index')}}" class="nk-menu-link">
                                <span class="nk-menu-icon"><i class="fa-regular fa-address-card fs-5"></i></span>
                                <span class="nk-menu-text">Account Settings</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{route('logout', ['type' => session('user_type') == 'client' ? 'client' : 'expert']) }}" class="nk-menu-link">
                            <span class="nk-menu-icon">
                                <i class="fa-regular fa-right-from-bracket tw-text-lg"></i>
                            </span>
                                <span class="nk-menu-text">Logout</span>
                            </a>
                        </li>
                    </section>
                </ul>
            </div>
        </div>
    </div>
</div>
