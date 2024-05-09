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
                        <div class="card-inner card-inner-lg pt-3 pb-4">
                            <div class="nk-block-head pb-0">
                                <a href="{{route('login.index', ['type' => 'expert'])}}" class="tw-flex tw-items-center tw-text-slate-700">
                                    <div class="tw-slate-700"><em class="icon ni ni-arrow-left tw-text-lg me-2"></em></div>
                                    <div>{{__('others.back_to_login')}}</div>
                                </a>
                            </div>
                            <div class="nk-block-head py-2">
                                <div class="center fw-bold fs-18px tw-text-slate-700 tw-underline">Expert Registration</div>
                            </div>
                            <div class="row gx-2">
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <div class="form-label-group mb-0">
                                            <label class="form-label" for="first-name">{{__('others.first_name')}}</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input autocomplete="off" type="text" class="form-control form-control-lg" name="first-name"
                                                   required id="first-name"
                                                   placeholder="{{__('others.first_name')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <div class="form-label-group mb-0">
                                            <label class="form-label" for="last-name">{{__('others.last_name')}}</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input autocomplete="off" type="text" class="form-control form-control-lg" name="last-name"
                                                   required id="last-name"
                                                   placeholder="{{__('others.last_name')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <div class="form-label-group mb-0">
                                    <label class="form-label" for="email-address">{{__('others.email')}}</label>
                                </div>
                                <div class="form-control-wrap">
                                    <input autocomplete="off" type="text" class="form-control form-control-lg" name="email"
                                           required id="email-address"
                                           placeholder="{{__('others.enter_email')}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group mb-0">
                                    <label class="form-label" for="password">{{__('others.password')}}</label>
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
                            <div class="form-group">
                                <label class="form-label" for="phone">{{__('others.phone_number')}}</label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="form-group">
                                                <div class="form-control-wrap  tw-w-[150px]">
                                                    <select name="phone-code" id="phone-code" data-search="on" class="form-select js-select2" data-value="2">
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->phonecode}}" @if($country->id == 199) selected @endif>
                                                                {{$country->emoji}} {{$country->iso2}} +{{str_replace('+', '', $country->phonecode)}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input id="phone" class="form-control" placeholder="{{__('others.phone_number')}}" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <p class="fs-14px text-center">{{__('others.by_clicking_register')}}<a tabindex="-1" href="{{route('others.policy')}}"> <br>{{__('others.privacy_policy')}}</a> &amp; <a tabindex="-1" href="{{route('others.terms')}}"> {{__('others.terms_conditions')}}.</a></p>
                            </div>
                            <div class="form-group mb-1">
                                <button type="submit" id="register-btn" onclick="register()" class="btn btn-lg btn-danger btn-block tw-py-2.5">
                                    {{__('others.register')}}
                                </button>
                            </div>
                            <div class="text-center pb-1">
                                <h6 class="overline-title overline-title-sap"><span>{{__('others.or')}}</span></h6>
                            </div>
                            <div class="tw-grid tw-grid-cols-2 tw-gap-x-1">
                                <a class="btn btn-outline-light center clickable">
                                    {{--                                   href="{{route('login.authenticate.social', ['driver' => 'google', 'user_type' => $type])}}">--}}
                                    <img src="/images/icons/google.svg" class="me-2" alt=""/>
                                    <span>{{__('others.google_login')}}</span>
                                </a>
                                <a class="btn btn-outline-light center clickable">
                                    {{--                                   href="{{route('login.authenticate.social', ['driver' => 'linkedin-openid', 'user_type' => $type])}}">--}}
                                    <img src="/images/icons/linkedin.svg" class="me-2" alt=""/>
                                    <span>{{__('others.linkedin_login')}}</span>
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
        //list of possible country, mostly asian, default to singapore if not found
        var timezone = moment.tz.guess();
        let countryCode = '65';
        if (timezone === 'Asia/Kuala_Lumpur') countryCode = '60';
        if (timezone === 'Asia/Singapore') countryCode = '65';
        if (timezone === 'Asia/Jakarta') countryCode = '62';
        if (timezone === 'Asia/Manila') countryCode = '63';
        if (timezone === 'Asia/Bangkok') countryCode = '66';
        if (timezone === 'Asia/Ho_Chi_Minh') countryCode = '84';
        if (timezone === 'Asia/Yangon') countryCode = '95';
        if (timezone === 'Asia/Phnom_Penh') countryCode = '855';
        if (timezone === 'Asia/Brunei') countryCode = '673';
        if (timezone === 'Asia/Dhaka') countryCode = '880';
        if (timezone === 'Asia/Kolkata') countryCode = '91';
        if (timezone === 'Asia/Tokyo') countryCode = '81';
        if (timezone === 'Asia/Seoul') countryCode = '82';
        if (timezone === 'Asia/Taipei') countryCode = '886';
        if (timezone === 'Asia/Hong_Kong') countryCode = '852';
        if (timezone === 'Asia/Macau') countryCode = '853';
        if (timezone === 'Asia/Shanghai') countryCode = '86';
        if (timezone === 'Asia/Kathmandu') countryCode = '977';
        if (timezone === 'Asia/Kabul') countryCode = '93';
        if (timezone === 'Asia/Tehran') countryCode = '98';
        if (timezone === 'Asia/Baghdad') countryCode = '964';
        if (timezone === 'Asia/Riyadh') countryCode = '966';
        if (timezone === 'Asia/Dubai') countryCode = '971';
        if (timezone === 'Asia/Beirut') countryCode = '961';
        if (timezone === 'Asia/Amman') countryCode = '962';
        if (timezone === 'Asia/Damascus') countryCode = '963';

        $('#phone-code').val(countryCode);

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
            let name = $('#first-name').val() + ' ' + $('#last-name').val();
            let phone = $('#phone').val();
            let phoneCode = $('#phone-code').val();
            let referer_code = '{{request()->query('ref')}}';
            $.ajax({
                url: "{{ route('register.store','expert')}}",
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    phone: phone,
                    phone_code: phoneCode,
                    referer_code: referer_code,
                    user_type: 'expert',
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

