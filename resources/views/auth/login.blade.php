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
                    <div class="card card-bordered mt-4">
                        <div class="tw-grid tw-grid-cols-2">
                            @if($type == 'expert')
                                <div
                                    class="dropdown-menu-s1 tw-rounded-tl-sm tw-px-5 tw-py-3 tw-flex tw-justify-center">
                                    <span class="text-danger"><i class="fa-solid fa-user-tie me-1"></i>Expert</span>
                                </div>
                                <a href="{{route('login.index', ["type" => 'client'])}}"
                                   class="tw-rounded-tr-sm bg-light tw-px-5 tw-py-3 tw-flex tw-justify-center clickable">
                                    <span class="tw-text-slate-500"><i
                                            class="fa-solid fa-briefcase me-1"></i>User/Client</span>
                                </a>
                            @else
                                <a href="{{route('login.index', ["type" => 'expert'])}}"
                                   class="tw-rounded-tr-sm bg-light tw-px-5 tw-py-3 tw-flex tw-justify-center clickable">
                                    <span class="tw-text-slate-500"><i
                                            class="fa-solid fa-user-tie me-1"></i>Expert</span>
                                </a>
                                <div
                                    class="dropdown-menu-s1 tw-rounded-tl-sm tw-px-5 tw-py-3 tw-flex tw-justify-center">
                                    <span class="text-danger"><i class="fa-solid fa-briefcase me-1"></i>User/Client</span>
                                </div>
                            @endif

                        </div>
                        <div class="card-inner card-inner-lg pt-4">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="email-address">Email</label>
                                </div>
                                <div class="form-control-wrap">
                                    <input autocomplete="off" type="text" class="form-control form-control-lg"
                                           name="email"
                                           required id="email-address"
                                           placeholder="Enter your email address or username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="password">Passcode</label>
                                    <a class="link link-primary link-sm" tabindex="-1"
                                       href="{{route('forgot_password.index')}}">Reset Password?</a>
                                </div>
                                <div class="form-control-wrap">
                                    <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg"
                                       data-target="password">
                                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                    </a>
                                    <input autocomplete="new-password" type="password"
                                           name="password"
                                           class="form-control form-control-lg" id="password"
                                           placeholder="Enter your passcode" required>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <button type="submit" onclick="login()"
                                        class="btn btn-lg btn-danger btn-block tw-py-2.5">
                                    Login as {{$type == 'client' ? 'Client' : 'Expert'}}
                                </button>
                            </div>
                            <div class="text-center pb-2">
                                <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                            </div>
                            <div class="tw-grid tw-grid-cols-2 tw-gap-x-1">
                                <a class="btn btn-outline-light center clickable" onclick="loginSocial('google')">
                                    <img src="/images/icons/google.svg" class="me-2" alt=""/>
                                    <span>Sign in with Google</span>
                                </a>
                                <a class="btn btn-outline-light center clickable" onclick="loginSocial('linkedin-openid')">
                                    <img src="/images/icons/linkedin.svg" class="me-2" alt=""/>
                                    <span>Sign in with LinkedIn</span>
                                </a>
{{--                                <a class="btn btn-outline-light center clickable"--}}
{{--                                   href="{{route('login.authenticate.social', ['driver' => 'google', 'user_type' => $type])}}">--}}
{{--                                    <img src="/images/icons/google.svg" class="me-2" alt=""/>--}}
{{--                                    <span>Sign in with Google</span>--}}
{{--                                </a>--}}
{{--                                <a class="btn btn-outline-light center clickable"--}}
{{--                                   href="{{route('login.authenticate.social', ['driver' => 'linkedin-openid', 'user_type' => $type])}}">--}}
{{--                                    <img src="/images/icons/linkedin.svg" class="me-2" alt=""/>--}}
{{--                                    <span>Sign in with LinkedIn</span>--}}
{{--                                </a>--}}
                            </div>
                            <div class="form-note-s2 text-center mt-3">
                                <span>New on our platform?</span>
                                <a class="tw-underline tw-text-red-500" href="{{route('register.index')}}">Create new Account</a>
                            </div>
                        </div>
                    </div>
                </div>
                @include('auth.footer')
            </div>
        </div>
        <input type="hidden" name="timezone" id="timezone">

    </div>

@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.13/moment-timezone-with-data.js"></script>
    <script>

        //create ajax login function
        var timezone = moment.tz.guess();
        $('#timezone').val(timezone);

        function loginSocial() {
            window.location.href = "{{route('login.authenticate.social', ['driver' => 'google', 'user_type' => $type, ''])}}/" + timezone.replace('/', '__');
        }

        $('#signInSelect').on('change', function () {
            if ($(this).val() === 'user') {
                $('.btn-primary').html('User Login');
                $('.btn-primary').attr('onclick', 'login()');
            } else {
                $('.btn-primary').html('Expert Login');
                $('.btn-primary').attr('onclick', 'loginExpert()');
            }
        })

        function login() {
            submitLoading();
            let email = $('#email-address').val();
            let password = $('#password').val();
            $.ajax({
                url: "{{ route('login.authenticate', ['type' => $type])}}",
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    timezone: timezone,
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    if (response.isadmin) {
                        console.log(response);
                        Swal.fire('Login as ' + response.isSuperAdmin === true ? 'Super Admin' : 'ADH Member', 'User is an admin, you will be directed to the admin page', 'success').then(() => window.location.href = "{{route('admin.overview.index')}}");
                    } else {
                        window.location.href = "{{$type == 'client' ? route('client.overview') : route('expert.overview')}}";
                    }
                },
                error: function (response) {
                    console.log(response)
                    _Swal.error(response.responseJSON.text, response.responseJSON.message, () => {
                        submitReset();
                    });
                }
            });
        }

        @if(session('verify'))
        Swal.fire({
            icon: 'success',
            title: 'Verification Success',
            text: '{{ session('verify') }}',
        });
        @endif

        // make so that if user press enter on password field, it will login
        $('#password').keypress(function (e) {
            if (e.which === 13) {
                login();
            }
        });
    </script>
@endpush

