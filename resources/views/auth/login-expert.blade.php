@extends('layouts.others.main')
@section('content')

    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap nk-wrap-nosidebar">
            <!-- content @s -->
            <div class="nk-content tw-relative"
                 style="background-image: url('/images/kuala_lumpur.jpg'); background-size: cover;">
                <div class="tw-absolute tw-inset-0 tw-bg-black tw-opacity-30"></div>
                <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                    <div class="brand-logo text-center">
                        <a href="/" class="logo-link">
                            <img class="logo-dark tw-w-52" src="/images/logo_2.png" alt="logo-dark">
                        </a>
                    </div>
                    <p class="text-center my-1 tw-text-slate-50">Digital business matchmaking platform</p>
                    <div class="card card-bordered mt-4">
                        <div class="card-inner card-inner-lg pt-2">
                            <div class="nk-block-head py-2">
                                <div class="center fw-bold fs-18px tw-text-slate-600">{{__('others.expert_login')}}</div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="email-address">{{__('others.email')}}</label>
                                </div>
                                <div class="form-control-wrap">
                                    <input autocomplete="off" type="text" class="form-control form-control-lg"
                                           name="email"
                                           required id="email-address"
                                           placeholder="{{__('others.enter_email')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label class="form-label" for="password">{{__('others.password')}}</label>
                                    <a class="link link-primary link-sm" tabindex="-1"
                                       href="{{route('forgot_password.index')}}">{{__('others.forgot_password')}}</a>
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
                                           placeholder="{{__('others.enter_password')}}" required>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <button type="submit" onclick="login()"
                                        class="btn btn-lg btn-danger btn-block tw-py-2.5">
                                    {{__('others.login')}}
                                </button>
                            </div>
                            <div class="text-center pb-2">
                                <h6 class="overline-title overline-title-sap"><span>{{__('others.or')}}</span></h6>
                            </div>
                            <div class="tw-grid tw-grid-cols-2 tw-gap-x-1">
                                <a class="btn btn-outline-light center clickable" onclick="loginGoogle('google')">
                                    <img src="/images/icons/google.svg" class="me-2" alt=""/>
                                    <span>{{__('others.google_login')}}</span>
                                </a>
                                <a class="btn btn-outline-light center clickable" onclick="loginLinkedIn('linkedin-openid')">
                                    <img src="/images/icons/linkedin.svg" class="me-2" alt=""/>
                                    <span>{{__('others.linkedin_login')}}</span>
                                </a>
                            </div>
                            <div class="form-note-s2 text-center mt-3">
                                <span>{{__('others.new_on_platform')}}</span>
                                <a class="tw-underline tw-text-red-500" href="{{route('register.index', 'expert')}}">{{__('others.create_account')}}</a>
                            </div>
{{--                            <div class="form-note-s2 text-center">--}}
{{--                                <a class="tw-underline tw-text-red-500" id="viewTest">Show Demo Account</a>--}}
{{--                            </div>--}}
{{--                            <div class="card card-bordered mt-3 d-none" id="test_container">--}}
{{--                                <div class="d-flex tw-justify-between">--}}
{{--                                    <div class="py-1 px-2">--}}
{{--                                        <p class="mb-0 fs-12px">Admin Email: superadmin@asiadealhub.com</p>--}}
{{--                                        <p class="mb-0 fs-12px">Admin Password: password</p>--}}
{{--                                    </div>--}}
{{--                                    <button onclick="pasteToEmailPassword('superadmin@asiadealhub.com', 'password')"--}}
{{--                                            class="btn btn-xs btn-primary"><em class="icon ni ni-copy fs-12px"></em></button>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex tw-justify-between border border-top">--}}
{{--                                    <div class="py-1 px-2">--}}
{{--                                        <p class="mb-0 fs-12px">Expert/Client Email: test@gmail.com</p>--}}
{{--                                        <p class="mb-0 fs-12px">Expert/Client Password: password</p>--}}
{{--                                    </div>--}}
{{--                                    <button onclick="pasteToEmailPassword('test@gmail.com', 'password')" class="btn btn-xs btn-primary"><em class="icon ni ni-copy fs-12px"></em></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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

        function loginGoogle() {
            window.location.href = "{{route('login.authenticate.social', ['driver' => 'google', 'user_type' => 'expert', ''])}}/" + timezone.replace('/', '__');
        }

        function loginLinkedIn() {
            window.location.href = "{{route('login.authenticate.social', ['driver' => 'linkedin-openid', 'user_type' => 'expert', ''])}}/" + timezone.replace('/', '__');
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
                url: "{{ route('login.authenticate', ['type' => 'expert'])}}",
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    timezone: timezone,
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    if (response.isadmin) {
                        console.log(response.isSuperAdmin);
                        let text = response.isSuperAdmin === true ? '{{__('others.admin')}}' : '{{__('others.adh_member')}}';
                        Swal.fire(text, '{{__('others.user_is_admin')}}', 'success').then(() => window.location.href = "{{route('admin.overview.index')}}");
                    } else {
                        window.location.href = "{{route('expert.overview.index')}}";
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

        @if (session('admin_error'))
        Swal.fire({
            icon: 'error',
            title: 'Social Login Error',
            text: 'This email is reserved for admins and admins cannot login using social account. Ask Super Admin to register you as an admin if you are not registered yet. User email and password to login into admin account.',
        });
        @endif

        $('#viewTest').click(function () {
            $('#test_container').toggleClass('d-none');
        });

        function pasteToEmailPassword(email, password) {
            $('#email-address').val(email);
            $('#password').val(password);
            $('#test_container').addClass('d-none');
        }
    </script>
@endpush

