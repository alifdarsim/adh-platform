<ul class="nk-nav nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link" href="{{route(session('user_type') == 'client' ? 'client.account.index' : 'expert.account.index')}}">Personal</a>
    </li>
    @if (session('user_type') == 'expert')
        <li class="nav-item">
            <a class="nav-link" href="{{route(session('user_type') == 'client' ? 'client.account.payment' : 'expert.account.payment')}}">Payment</a>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{route(session('user_type') == 'client' ? 'client.account.security' : 'expert.account.security')}}">Security</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route(session('user_type') == 'client' ? 'client.account.notification' : 'expert.account.notification')}}">Notifications</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route(session('user_type') == 'client' ? 'client.account.activity' : 'expert.account.activity')}}">Activity</a>
    </li>
</ul>
