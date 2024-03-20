<div class="nk-header-menu" data-content="headerNav">
    <div class="nk-header-mobile">
        <div class="nk-header-brand">
            <a href="{{route('client.overview')}}" class="logo-link">
                <img class="logo-light logo-img" src="/images/logo.png" srcset="/images/logo2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="/images/logo-dark.png" srcset="/images/logo-dark2x.png 2x" alt="logo-dark">
                <span class="nio-version">Expert</span>
            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div>
    <!-- Menu -->
    <ul class="nk-menu nk-menu-main">
        <li class="nk-menu-item">
            <a href="{{route('client.overview')}}" class="nk-menu-link">
                <span class="nk-menu-text">Overview</span>
            </a>
        </li>
        <li class="nk-menu-item has-sub">
            <a href="#" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-icon"><i class="fa-regular fa-box-dollar fs-5"></i></span>
                <span class="nk-menu-text">Projects</span>
            </a>
            <ul class="nk-menu-sub">
                <li class="nk-menu-item">
                    <a href="{{route('client.projects.index')}}" class="nk-menu-link">
                        <span class="nk-menu-text">Manage Projects</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="{{route('client.projects.create')}}" class="nk-menu-link">
                        <span class="nk-menu-text">Create Projects</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nk-menu-item">
            <a href="{{route('client.payment.index')}}" class="nk-menu-link">
                <span class="nk-menu-text">Payment</span>
            </a>
        </li>
        <li class="nk-menu-item has-sub">
            <a href="#" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-icon"><i class="fa-regular fa-box-dollar fs-5"></i></span>
                <span class="nk-menu-text">COMPANY</span>
            </a>
            <ul class="nk-menu-sub">
                <li class="nk-menu-item">
                    <a href="{{route('client.company.index')}}" class="nk-menu-link">
                        <span class="nk-menu-text">My Company</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="{{route('client.company.create')}}" class="nk-menu-link">
                        <span class="nk-menu-text">Create Company</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="{{route('client.team.index')}}" class="nk-menu-link">
                        <span class="nk-menu-text">Manage My Team</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="{{route('client.team.create')}}" class="nk-menu-link">
                        <span class="nk-menu-text">Create Team</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
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
