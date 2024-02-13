@extends('expert.layout.main')
@section('content')
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <div class="nk-block-head-sub"><span>My Profile</span></div>
                            <h2 class="nk-block-title fw-normal">Account Info</h2>
                            <div class="nk-block-des">
                                <p>You have full control to manage your own account setting. <span class="text-primary"><em class="icon ni ni-info"></em></span></p>
                            </div>
                        </div>
                    </div>
                    @include('expert.profile.tabs')
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Personal Information</h5>
                                <div class="nk-block-des">
                                    <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-bordered">
                            <div class="nk-data data-list">
                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Full Name</span>
                                        <span class="data-value">{{auth()->user()->name}}</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Email</span>
                                        <span class="data-value">{{auth()->user()->email}}</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                </div>
                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Phone Number</span>
                                        <span class="data-value {{auth()->user()->contact?'':'text-soft'}}">{{auth()->user()->contact ?? 'Not set yet'}}</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div>
                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                    <div class="data-col">
                                        <span class="data-label">Date of Birth</span>
                                        <span class="data-value {{auth()->user()->birthday?'':'text-soft'}}">{{auth()->user()->birthday ?? 'Not set yet'}}</span>
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div>
                                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit" data-tab-target="#address">
                                    <div class="data-col">
                                        <span class="data-label">Address</span>
{{--                                        <span class="data-value">{{auth()->user()->country->name?'':'text-soft'}}</span>--}}
                                    </div>
                                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                </div>
                            </div><!-- .nk-data -->
                        </div><!-- .card -->
                        <!-- Another Section -->
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Personal Preferences</h5>
                                <div class="nk-block-des">
                                    <p>Your personalized preference allows you best use.</p>
                                </div>
                            </div>
                        </div><!-- .nk-block-head -->
                        <div class="card card-bordered">
                            <div class="nk-data data-list">
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Language</span>
                                        <span class="data-value">English (United State)</span>
                                    </div>
                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change Language</a></div>
                                </div>
                                <div class="data-item">
                                    <div class="data-col">
                                        <span class="data-label">Timezone</span>
                                        <span class="data-value">Bangladesh (GMT +6)</span>
                                    </div>
                                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
                                </div>
                            </div><!-- .nk-data -->
                        </div><!-- .card -->
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

