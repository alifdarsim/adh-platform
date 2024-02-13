@extends('expert.layout.main')
@section('content')
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="{{route('expert.profile')}}"><em class="icon ni ni-arrow-left"></em><span>My Profile</span></a></div>
                            <h2 class="nk-block-title fw-normal">Account Setting</h2>
                            <div class="nk-block-des">
                                <p>You have full control to manage your own account setting. <span class="text-primary"><em class="icon ni ni-info"></em></span></p>
                            </div>
                        </div>
                    </div>
                    @include('expert.profile.tabs')
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Security Settings</h5>
                                <div class="nk-block-des">
                                    <p>These settings are helps you keep your account secure.</p>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="card card-bordered">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="between-center flex-wrap flex-md-nowrap g-3">
                                        <div class="nk-block-text">
                                            <h6>Send Email When Login with New Browser</h6>
                                            <p>When enabled, we will send you an email notification every time you login from a new browser.</p>
                                        </div>
                                        <div class="nk-block-actions">
                                            <ul class="align-center gx-3">
                                                <li class="order-md-last">
                                                    <div class="custom-control custom-switch me-n2">
                                                        <input type="checkbox" class="custom-control-input" checked="" id="activity-log">
                                                        <label class="custom-control-label" for="activity-log"></label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="between-center flex-wrap flex-md-nowrap g-3">
                                        <div class="nk-block-text">
                                            <h6>Change Password</h6>
                                            <p>Set a unique password to protect your account.</p>
                                        </div>
                                        <div class="nk-block-actions flex-shrink-sm-0">
                                            <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                <li class="order-md-last">
                                                    <a href="#" class="btn btn-primary">Change Password</a>
                                                </li>
                                                <li>
                                                    <em class="text-soft text-date fs-12px">Last changed: <span>Oct 2, 2019</span></em>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="between-center flex-wrap flex-md-nowrap g-3">
                                        <div class="nk-block-text">
                                            <h6>2FA Authentication <span class="badge bg-light">Disabled</span></h6>
                                            <p>Secure your account with 2FA security. When it is activated you will need to enter not only your password, but also a special code using app. You can receive this code by in mobile app. </p>
                                        </div>
                                        <div class="nk-block-actions">
                                            <btn class="btn tw-bg-slate-200 tw-w-36 justify-center tw-cursor-not-allowed">Not Available</btn>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner-group -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush

