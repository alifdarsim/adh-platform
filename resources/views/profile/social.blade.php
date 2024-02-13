@extends('layouts.others.main')
@section('content')

    <x-content_header title="Profile" subtitle=""/>

    <div class="nk-block">
        <div class="card card-bordered mt-0">
            <div class="card-aside-wrap">
                <div class="card-inner card-inner-lg">
                    <div class="nk-block">
                        <div class="nk-block-head mb-2">
                            <div class="nk-block-between">
                                <div class="nk-block-head-content">
                                    <h5 class="nk-block-title">Connected with Social Account</h5>
                                    <div class="nk-block-des"><p>You can connect with your social account such as google
                                            and linkedin to make easier for you to login into account.</p></div>
                                </div>
                            </div>
                        </div>
                        <h6 class="lead-text">Connect to LinkedIn (Recommended)</h6>
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                    <div class="media media-center gx-3 wide-xs">
                                        <div class="tw-flex tw-items-center">
                                            <em class="tw-bg-blue-500 ni ni-linkedin text-white p-2 fs-2 tw-rounded-2xl"></em>
                                            <p class="ms-2">You have successfully connected with your facebook account,
                                                you can easily log in using your account too.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-actions flex-shrink-0">
                                        <a href="#" class="btn btn-lg tw-bg-green-500 text-white">Connected</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="lead-text">Connect to Google</h6>
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                    <div class="media media-center gx-3 wide-xs">
                                        <div class="tw-flex tw-items-center">
                                            <em class="tw-bg-red-500 ni ni-google text-white p-2 fs-2 tw-rounded-2xl"></em>
                                            <p class="ms-2">You can connect with your google account.
                                                <em class="d-block text-soft">Not connected yet</em>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="nk-block-actions flex-shrink-0"><a href="#"
                                                                                   class="btn btn-lg btn-dim btn-primary">Connect</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('profile.layout')
            </div>
        </div>
    </div>

@endsection


