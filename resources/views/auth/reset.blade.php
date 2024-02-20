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
                    <div class="card card-bordered mt-3 p-5">
                        <div class="nk-block-head pb-2">
                            <a href="{{route('login.index', ['type' => 'expert'])}}" class="tw-flex tw-items-center tw-text-slate-700">
                                <div class="tw-slate-700"><em class="icon ni ni-arrow-left tw-text-lg me-2"></em></div>
                                <div>Back to Login</div>
                            </a>
                        </div>
                        <div class="nk-block-head">
                            <div class="nk-block-head-content"><h5 class="nk-block-title">Password Reset</h5>
                                <div class="nk-block-des">
                                    <p>We will send you an email with a link to reset your password.</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <label class="form-label" for="email">Email</label>
                            </div>
                            <div class="form-control-wrap">
                                <input class="form-control form-control-lg" id="email"
                                       placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="form-group">
                            <button onclick="reset()" class="btn btn-lg btn-primary btn-block">Send Reset Password Link</button>
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
    // const getToken = () => window.location.href.split('/').pop();

    function reset() {
        let email = $('#email').val();
        $.ajax({
            url: "{{route('forgot_password.store', '')}}/" + email,
            type: 'POST',
            data: {
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
