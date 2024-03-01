@extends('layouts.user.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Payment Details</h3>
                <div class="nk-block-des text-soft"><p>Set up your payment details to get paid.</p></div>
            </div>
        </div>
    </div>
    @include('expert.account.tabs')
    <div class="nk-block">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h5 class="nk-block-title">Personal Information</h5>
                <div class="nk-block-des">
                    <p>Basic info, like your name and address, that you use on AsiaDealHub account.</p>
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
                        <span class="data-value {{auth()->user()->phone ? '':'text-soft'}}">{{auth()->user()->phone ?? 'Not set yet'}}</span>
                    </div>
                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                </div>
            </div>
        </div>
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
                        <span class="data-value">{{auth()->user()->timezone}}</span>
                    </div>
                    <div class="data-col data-col-end"><a href="#" class="link link-primary">Change</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush

