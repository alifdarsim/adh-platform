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
                        <div class="nk-block-head">
                            <div class="nk-block-head-content"><h5 class="nk-block-title">Reset Password</h5>
                                <div class="nk-block-des">
                                    <p>Please confirm your reset password for your AsiaDealHub account.</p>
                                    <span class="fs-12px">Login Email:</span><p class="fs-14px bg-light rounded px-2 py-2"> {{$email->email}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password1">Password</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control form-control-lg" id="password1"
                                       placeholder="Enter your password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="password2">Confirm Password</label>
                            </div>
                            <div class="form-control-wrap">
                                <input type="password" class="form-control form-control-lg" id="password2"
                                       placeholder="Confirm your password">
                            </div>
                        </div>
                        <div class="form-group">
                            <button onclick="reset()" class="btn btn-lg btn-primary btn-block">Confirm New Password</button>
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

<script>
    const getToken = () => window.location.href.split('/').pop();

    function reset() {
        $.ajax({
            url: "{{route('forgot_password.update', '')}}/" + getToken(),
            type: 'PUT',
            data: {
                "password": $('#password1').val(),
                "password_confirmation": $('#password2').val(),
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                Swal.fire('Success', data.message, 'success').then(e => {
                    window.location.href = "{{route('login.index', ['type' => 'expert'])}}";
                });
            },
            error: function (data) {
                Swal.fire('Error!', data.responseJSON.message, 'error')
            }
        });
    }

</script>
