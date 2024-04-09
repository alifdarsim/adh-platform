<li class="nk-menu-heading">
    <h6 class="overline-title text-primary-alt">Management</h6>
</li>
<li class="nk-menu-item">
    <a href="{{route('client.overview')}}" class="nk-menu-link">
        <span class="nk-menu-icon"><i class="fa-regular fa-chart-tree-map fs-5"></i></span>
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
        <span class="nk-menu-icon"><i class="fa-regular fa-coin fs-5"></i></span>
        <span class="nk-menu-text">Payments</span>
    </a>
</li>
<li class="nk-menu-item has-sub">
    <a href="#" class="nk-menu-link nk-menu-toggle">
        <span class="nk-menu-icon"><i class="fa-regular fa-box-dollar fs-5"></i></span>
        <span class="nk-menu-text">Company</span>
    </a>
    <ul class="nk-menu-sub">
        <li class="nk-menu-item">
            <a href="{{route('client.company.index')}}" class="nk-menu-link">
                <span class="nk-menu-text">Your Company</span>
            </a>
        </li>
        <li class="nk-menu-item">
            <a href="{{route('client.company.create')}}" class="nk-menu-link">
                <span class="nk-menu-text">Create New Company</span>
            </a>
        </li>
    </ul>
</li>
<section>
    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Misc</h6>
    </li>
    <li class="nk-menu-item">
        <a href="{{route('client.account.index')}}" class="nk-menu-link">
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
