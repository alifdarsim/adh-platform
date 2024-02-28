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
                        <div class="card-inner card-inner-lg pt-3 pb-4">
                            <div class="nk-block-head pb-0">
                                <a href="{{route('login.index', ['type' => 'expert'])}}" class="tw-flex tw-items-center tw-text-slate-700">
                                    <div class="tw-slate-700"><em class="icon ni ni-arrow-left tw-text-lg me-2"></em></div>
                                    <div>Back to Login</div>
                                </a>
                            </div>
                            <div class="nk-block-head py-2">
                                <div class="center fw-bold fs-18px tw-text-slate-700 tw-underline">Expert Registration</div>
                            </div>
                            <div class="form-group mb-2">
                                <div class="form-label-group mb-0">
                                    <label class="form-label" for="email-address">Email</label>
                                </div>
                                <div class="form-control-wrap">
                                    <input autocomplete="off" type="text" class="form-control form-control-lg" name="email"
                                           required id="email-address"
                                           placeholder="Enter your email address or username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group mb-0">
                                    <label class="form-label" for="password">Passcode (6+ characters)</label>
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
                                <p class="fs-14px text-center">By clicking Register, you agree to AsiaDealHub<a tabindex="-1" href="{{route('others.policy')}}"> <br>Privacy Policy</a> &amp; <a tabindex="-1" href="{{route('others.terms')}}"> Terms & Conditions.</a></p>
                            </div>
                            <div class="form-group mb-1">
                                <button type="submit" id="register-btn" onclick="register()" class="btn btn-lg btn-danger btn-block tw-py-2.5">
                                    Register
                                </button>
                            </div>
                            <div class="text-center pb-1">
                                <h6 class="overline-title overline-title-sap"><span>OR</span></h6>
                            </div>
                            <div class="tw-grid tw-grid-cols-2 tw-gap-x-1">
                                <a class="btn btn-outline-light center clickable">
                                    {{--                                   href="{{route('login.authenticate.social', ['driver' => 'google', 'user_type' => $type])}}">--}}
                                    <img src="/images/icons/google.svg" class="me-2" alt=""/>
                                    <span>Register with Google</span>
                                </a>
                                <a class="btn btn-outline-light center clickable">
                                    {{--                                   href="{{route('login.authenticate.social', ['driver' => 'linkedin-openid', 'user_type' => $type])}}">--}}
                                    <img src="/images/icons/linkedin.svg" class="me-2" alt=""/>
                                    <span>Register with LinkedIn</span>
                                </a>
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

        // $('#email-address').val('alifdarsim@gmail.com');
        // $('#password').val('password');

        $('#signInSelect').on('change', function () {
            if ($(this).val() === 'user') {
                $('.btn-primary').html('User Login');
                $('.btn-primary').attr('onclick', 'login()');
            } else {
                $('.btn-primary').html('Expert Login');
                $('.btn-primary').attr('onclick', 'loginExpert()');
            }
        })

        function register() {
            submitLoading();
            _Swal.loading('Registering', 'Please wait while we are creating your account...');
            let email = $('#email-address').val();
            let password = $('#password').val();
            $.ajax({
                url: "{{ route('register.store','')}}/"+'expert',
                method: 'POST',
                data: {
                    email: email,
                    password: password,
                    timezone: timezone,
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    _Swal.success('Register Success', 'You have registered successfully, you can now login as Expert. Don\'t forget to confirm your email.', () => {
                        window.location.href = "{{route('login.index', ['type' => 'expert'])}}";
                    });
                },
                error: function (response) {
                    Swal.fire('Verify your Email', response.responseJSON.message, 'error').then(() => {
                        submitReset();
                        $('button[type="submit"]').html('Register');
                    });
                }
            });
        }

        // make so that if user press enter on password field, it will login
        $('#password').keypress(function (e) {
            if (e.which === 13) {
                register();
            }
        });
    </script>
@endpush

