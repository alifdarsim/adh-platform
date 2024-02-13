@extends('layouts.user.main')
@section('content')
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="{{route('expert.profile')}}"><em class="icon ni ni-arrow-left"></em><span>My Profile</span></a></div>
                            <h2 class="nk-block-title fw-normal">Account Notification</h2>
                            <div class="nk-block-des">
                                <p>You have full control to manage your own account setting. <span class="text-primary"><em class="icon ni ni-info"></em></span></p>
                            </div>
                        </div>
                    </div>
                    @include('expert.profile.tabs')
                    <div class="nk-block">
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-head-content">
                                <div class="nk-block-title-group">
                                    <h6 class="nk-block-title title">Recent Activity</h6>
                                </div>
                                <div class="nk-block-des">
                                    <p>This information about the last login activity on your account (Max shown 20 data)</p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-bordered">
                            <table class="table table-ulogs">
                                <thead class="table-light">
                                <tr>
                                    <th class="tb-col-os"><span class="overline-title">Device <span class="d-sm-none">/ IP</span></span></th>
                                    <th class="tb-col-ip"><span class="overline-title">Platform</span></th>
                                    <th class="tb-col-time"><span class="overline-title">Browser</span></th>
                                    <th class="tb-col-time"><span class="overline-title">IP Address</span></th>
                                    <th class="tb-col"><span class="overline-title">Timestamp</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($auth_logs as $log)
                                    <tr>
                                        <td class="tb-col-os">{{$log->device}}</td>
                                        <td class="tb-col-ip"><span class="sub-text">{{$log->platform}}</span></td>
                                        <td class="tb-col-time"><span class="sub-text">{{$log->browser}}</span></td>
                                        <td class="tb-col-time"><span class="sub-text">{{$log->ip_address}}</span></td>
                                        <td class="tb-col-time"><span class="sub-text">{{$log->timestamp}}</span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush

