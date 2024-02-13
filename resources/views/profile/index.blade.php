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
                                <h4 class="nk-block-title">Personal Information</h4>
                                <div class="nk-block-des">
                                    <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content align-self-start d-lg-none">
                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em
                                            class="icon ni ni-menu-alt-r"></em></a>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="nk-data data-list">
                            <div class="data-head">
                                <h6 class="overline-title">Basics</h6>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Full Name</span>
                                    <span class="data-value">{{auth()->user()->name}}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more disable"><em
                                                class="icon ni ni-lock-alt"></em></span></div>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Email</span>
                                    <span class="data-value">{{auth()->user()->email}}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more disable"><em
                                                class="icon ni ni-lock-alt"></em></span></div>
                            </div>
                            <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Phone Number</span>
                                    <span class="data-value text-soft">{{auth()->user()->phone ?? 'Not add yet'}}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more"><em
                                                class="icon ni ni-forward-ios"></em></span></div>
                            </div>
                            <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                <div class="data-col">
                                    <span class="data-label">Date of Birth</span>
                                    <span class="data-value">{{auth()->user()->birthday ?? 'Not add yet'}}</span>
                                </div>
                                <div class="data-col data-col-end"><span class="data-more"><em
                                                class="icon ni ni-forward-ios"></em></span></div>
                            </div>
                        </div>
                        <div class="nk-data data-list">
                            <div class="data-head">
                                <h6 class="overline-title">Preferences</h6>
                            </div>
                            <div class="data-item">
                                <div class="data-col">
                                    <span class="data-label">Language</span>
                                    <span class="data-value">English (United State)</span>
                                </div>
                                <div class="data-col data-col-end"><a href="#" class="link link-primary">Change
                                        Language</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('profile.layout')
            </div>
        </div>
    </div>

@endsection


