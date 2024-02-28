<div class="nk-header-menu" data-content="headerNav">
    <div class="nk-header-mobile">
        <div class="nk-header-brand">
            <a href="{{route('expert.overview')}}" class="logo-link">
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
            <a href="{{route('expert.overview')}}" class="nk-menu-link">
                <span class="nk-menu-text">Overview</span>
            </a>
        </li>
        <li class="nk-menu-item">
            <a href="{{route('expert.projects.index')}}" class="nk-menu-link">
                <span class="nk-menu-text">Projects</span>
            </a>
        </li>
        <li class="nk-menu-item has-sub">
            <a href="#" class="nk-menu-link nk-menu-toggle">
                <span class="nk-menu-text">EXPERT</span>
            </a>
            <ul class="nk-menu-sub">
                <li class="nk-menu-item">
                    <a href="{{route('expert.profile.index')}}" class="nk-menu-link">
                        <span class="nk-menu-text">Expert Profile</span>
                    </a>
                </li>
                <li class="nk-menu-item">
                    <a href="{{route('expert.assessment.index')}}" class="nk-menu-link">
                        <span class="nk-menu-text">Expert Assessment</span>
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
