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
                <span class="nio-version tw-text-slate-300">ADMIN DASHBOARD</span>
            </a>
        </div>
    </div>
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Management</h6>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{route('admin.overview.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fa-regular fa-chart-tree-map fs-5"></i></span>
                            <span class="nk-menu-text">Overview</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><i class="fa-regular fa-handshake fs-5"></i></span>
                            <span class="nk-menu-text">Projects</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.projects.index')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Projects List</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.projects.create')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Create Projects</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><i class="fa-solid fa-user-tie fs-5"></i></span>
                            <span class="nk-menu-text">Experts</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.experts.index')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Expert List</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.expert_scrape.index')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">LinkedIn Scrape</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{route('admin.users.index')}}" class="nk-menu-link">
                            <span class="nk-menu-icon"><i class="fa-regular fa-users fs-5"></i></span>
                            <span class="nk-menu-text">Users</span>
                        </a>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><i class="fa-solid fa-user-crown fs-5"></i></span>
                            <span class="nk-menu-text">ADH Admins</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.admins.index')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Member List</span>
                                </a>
                            </li>
                            @if(auth()->user()->hasRole('super admin'))
                                <li class="nk-menu-item">
                                    <a href="{{route('admin.admins.create')}}" class="nk-menu-link">
                                        <span class="nk-menu-text">Create Member</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><i class="fa-regular fa-buildings fs-5"></i></span>
                            <span class="nk-menu-text">Companies</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{route('admin.companies.index')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Companies List</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.companies.create')}}" class="nk-menu-link">
                                    <span class="nk-menu-text">Add Companies</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if (auth()->user()->hasRole('super admin'))
                    <seciton>
                        <li class="nk-menu-heading pt-3">
                            <h6 class="overline-title text-primary-alt">SYSTEM SETTING</h6>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{route('admin.hubs.index')}}" class="nk-menu-link">
                                <span class="nk-menu-icon"><i class="fa-regular fa-circle-nodes fs-5"></i></span>
                                <span class="nk-menu-text">Hubs</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{route('admin.industry_classification.index')}}" class="nk-menu-link">
                                <span class="nk-menu-icon"><i class="fa-regular fa-industry-windows fs-5"></i></span>
                                <span class="nk-menu-text">Industry Classification</span>
                            </a>
                        </li>
{{--                        <li class="nk-menu-item">--}}
{{--                            <a href="{{route('admin.contract.index')}}" class="nk-menu-link">--}}
{{--                                <span class="nk-menu-icon"><i class="fa-regular fa-file-signature fs-5"></i></span>--}}
{{--                                <span class="nk-menu-text">Default Contract</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><i class="fa-regular fa-file-signature fs-5"></i></span>
                                <span class="nk-menu-text">Contract</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{route('admin.contract.show', 'expert')}}" class="nk-menu-link">
                                        <span class="nk-menu-text">Expert Contract</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{route('admin.contract.show', 'client')}}" class="nk-menu-link">
                                        <span class="nk-menu-text">Client Contract</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </seciton>
                    <seciton>
                        <li class="nk-menu-heading pt-3">
                            <h6 class="overline-title text-primary-alt">CONTENT MANAGEMENT</h6>
                        </li>
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><i class="fa-regular fa-message-pen fs-5"></i></span>
                                <span class="nk-menu-text">Resources</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{route('admin.post.index')}}" class="nk-menu-link">
                                        <span class="nk-menu-text">Posts</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{route('admin.post.create')}}" class="nk-menu-link">
                                        <span class="nk-menu-text">Create Post</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><i class="fa-regular fa-newspaper fs-5"></i></span>
                                <span class="nk-menu-text">Terms Editors</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="{{route('admin.editor.terms_conditions')}}" class="nk-menu-link">
                                        <span class="nk-menu-text">Terms & Conditions</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{route('admin.editor.privacy')}}" class="nk-menu-link">
                                        <span class="nk-menu-text">Privacy Policy</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="{{route('admin.editor.faq')}}" class="nk-menu-link">
                                        <span class="nk-menu-text">FAQ</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nk-menu-item">
                            <a href="{{route('quiz.show')}}" class="nk-menu-link">
                                <span class="nk-menu-icon"><i class="fa-regular fa-user-helmet-safety fs-5"></i></span>
                                <span class="nk-menu-text">Expert Assessment</span>
                            </a>
                        </li>
                    </seciton>
                    @endif

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
