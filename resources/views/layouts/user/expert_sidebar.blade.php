<li class="nk-menu-heading">
    <h6 class="overline-title text-primary-alt">Management</h6>
</li>
<li class="nk-menu-item">
    <a href="{{route('expert.overview.index')}}" class="nk-menu-link">
        <span class="nk-menu-icon"><i class="fa-regular fa-chart-tree-map fs-5"></i></span>
        <span class="nk-menu-text">Overview</span>
    </a>
</li>
<li class="nk-menu-item">
    <a href="{{route('expert.projects.index')}}" class="nk-menu-link">
        <span class="nk-menu-icon"><i class="fa-regular fa-briefcase fs-5"></i></span>
        <span class="nk-menu-text">Manage Projects</span>
    </a>
</li>
<li class="nk-menu-item">
    <a href="{{route('expert.projects.invited')}}" class="nk-menu-link">
        <span class="nk-menu-icon"><i class="fa-regular fa-business-time fs-5"></i></span>
        <span class="nk-menu-text">Invited Projects</span>
    </a>
</li>
<li class="nk-menu-item">
    <a href="{{route('expert.projects.public')}}" class="nk-menu-link">
        <span class="nk-menu-icon"><i class="fa-regular fa-briefcase-arrow-right fs-5"></i></span>
        <span class="nk-menu-text">Public Projects</span>
    </a>
</li>
<li class="nk-menu-item">
    <a href="{{route('expert.contract.index')}}" class="nk-menu-link">
        <span class="nk-menu-icon"><i class="fa-regular fa-file-signature fs-5"></i></span>
        <span class="nk-menu-text">Contract</span>
    </a>
</li>
<li class="nk-menu-item">
    <a href="{{route('expert.payment.index')}}" class="nk-menu-link">
        <span class="nk-menu-icon"><i class="fa-regular fa-coin fs-5"></i></span>
        <span class="nk-menu-text">Payments</span>
    </a>
</li>
<li class="nk-menu-item">
    <a href="{{route('expert.profile.index')}}" class="nk-menu-link">
        <span class="nk-menu-icon"><i class="fa-regular fa-user-helmet-safety fs-5"></i></span>
        <span class="nk-menu-text">Expert Profile</span>
    </a>
</li>
<li class="nk-menu-item">
    <a href="{{route('expert.assessment.index')}}" class="nk-menu-link">
        <span class="nk-menu-icon"><i class="fa-regular fa-memo-pad fs-5"></i></span>
        <span class="nk-menu-text">Assessment</span>
    </a>
</li>
<section>
    <li class="nk-menu-heading">
        <h6 class="overline-title text-primary-alt">Misc</h6>
    </li>
    <li class="nk-menu-item">
        <a href="{{route('expert.referer.index')}}" class="nk-menu-link">
            <span class="nk-menu-icon"><i class="fa-regular fa-link fs-5"></i></span>
            <span class="nk-menu-text">Referral Link</span>
        </a>
    </li>
    <li class="nk-menu-item">
        <a href="{{route('expert.account.index')}}" class="nk-menu-link">
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
