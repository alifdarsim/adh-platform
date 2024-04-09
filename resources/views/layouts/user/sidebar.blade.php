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
                <ul class="nk-menu">

                    @if(session('user_type') == 'expert')
                        @include('layouts.user.expert_sidebar')
                    @else
                        @include('layouts.user.client_sidebar')
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
