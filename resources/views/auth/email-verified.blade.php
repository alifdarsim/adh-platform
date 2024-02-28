@extends('layouts.others.main')
@section('content')

    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content tw-relative"
                 style="background-image: url('/images/singapore.jpg'); background-size: cover;">
                <div class="tw-absolute tw-inset-0 tw-bg-black tw-opacity-30"></div>
                <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                    <div class="brand-logo text-center">
                        <a href="/" class="logo-link">
                            <img class="logo-dark tw-w-52" src="/images/logo_2.png" alt="logo-dark">
                        </a>
                    </div>
                    <p class="text-center my-1 tw-text-slate-50">Digital business matchmaking platform</p>
                    <div class="card card-bordered mt-4 p-5">
                        <div class="nk-block-head ">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title center">Email Verified!</h5>
                                <div class="nk-block-des">
                                    <p class="tw-text-center">You have successfully verified your email. You can log in now.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{route('login.index', 'expert')}}" class="btn btn-lg btn-primary btn-block">Go to Login Page</a>
                        </div>
                    </div>
                </div>
                @include('auth.footer')
            </div>
        </div>
    </div>
@endsection

<script src="/assets/js/bundle.js?ver=3.2.2"></script>
<script src="/assets/js/scripts.js?ver=3.2.2"></script>
