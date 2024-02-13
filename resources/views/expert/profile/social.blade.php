@extends('expert.layout.main')
@section('content')
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><a class="back-to" href="{{route('expert.profile')}}"><em class="icon ni ni-arrow-left"></em><span>My Profile</span></a></div>
                            <h2 class="nk-block-title fw-normal">Social Connect</h2>
                            <div class="nk-block-des">
                                <p>You have full control to manage your own account setting. <span class="text-primary"><em class="icon ni ni-info"></em></span></p>
                            </div>
                        </div>
                    </div>
                    @include('expert.profile.tabs')
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Connected with Social Account</h5>
                                <div class="nk-block-des">
                                    <p>You can connect with your social account such as facebook, google etc to make easier to login into account.</p>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <h6 class="lead-text">Connect to Facebook</h6>
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                    <div class="media media-center gx-3 wide-xs">
                                        <div class="media-object">
                                            <em class="icon icon-circle icon-circle-lg ni ni-facebook-f"></em>
                                        </div>
                                        <div class="media-content">
                                            <p>You have successfully connected with your facebook account, you can easily log in using your account too.</p>
                                        </div>
                                    </div>
                                    <div class="nk-block-actions flex-shrink-0">
                                        <a href="#" class="btn btn-lg btn-danger">Revoke Access</a>
                                    </div>
                                </div>
                            </div><!-- .nk-card-inner -->
                        </div><!-- .nk-card -->
                        <h6 class="lead-text">Connect to Google</h6>
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                    <div class="media media-center gx-3 wide-xs">
                                        <div class="media-object">
                                            <em class="icon icon-circle icon-circle-lg ni ni-google"></em>
                                        </div>
                                        <div class="media-content">
                                            <p>You can connect with your google account. <em class="d-block text-soft">Not connected yet</em></p>
                                        </div>
                                    </div>
                                    <div class="nk-block-actions flex-shrink-0">
                                        <a href="#" class="btn btn-lg btn-dim btn-primary">Connect</a>
                                    </div>
                                </div>
                            </div><!-- .nk-card-inner -->
                        </div><!-- .nk-card -->
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-head-content">
                                <h6 class="nk-block-title">Import Contacts <a href="#" class="link link-primary ms-auto">Import from Google</a></h6>
                                <div class="nk-block-des">
                                    <p>You have not imported contacts from your mobile phone.</p>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
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

