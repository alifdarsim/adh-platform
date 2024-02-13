@extends('layouts.others.main')
@section('content')

    <x-content_header title="Profile" subtitle=""/>

    <div class="nk-block">
        <div class="card card-bordered mt-0">
            <div class="card-aside-wrap">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block-head nk-block-head-lg">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h4 class="nk-block-title">Login Activity</h4>
                                <div class="nk-block-des">
                                    <p>Here is your last 20 login activities log.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content align-self-start d-lg-none">
                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em
                                            class="icon ni ni-menu-alt-r"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block card card-bordered">
                        <table class="table table-ulogs">
                            <thead class="table-light">
                            <tr>
                                <th class="tb-col-os"><span class="overline-title">Browser</span></th>
                                <th class="tb-col-os"><span class="overline-title">Device</span></th>
                                <th class="tb-col-os"><span class="overline-title">Platform</span></th>
                                <th class="tb-col-ip"><span class="overline-title">IP</span></th>
                                <th class="tb-col-time"><span class="overline-title">Time</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($auth_logs as $log)
                                <tr>
                                    <td class="tb-col-os">{{$log->browser}}</td>
                                    <td class="tb-col-ip"><span class="sub-text">{{$log->device}}</span></td>
                                    <td class="tb-col-ip"><span class="sub-text">{{$log->platform}}</span></td>
                                    <td class="tb-col-time"><span class="sub-text">{{$log->ip_address}}</span></td>
                                    <td class="tb-col-time"><span class="sub-text">{{$log->created_at}}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @include('profile.layout')
            </div>
        </div>
    </div>

@endsection


