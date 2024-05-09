@extends('layouts.admin.main')
@section('content')
    <style>
        .select2-dropdown {
            z-index: 9999999999 !important;
        }
    </style>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Account Information</h3>
                <div class="nk-block-des text-soft"><p>Your AsiaDealHub account information.</p></div>
            </div>
        </div>
    </div>
    @include('admin.account.tabs')
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
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">Profile Image</span>
                        <img src="{{auth()->user()->user_avatar()}}" alt="profile image" class="data-img tw-rounded-2xl">
                    </div>
                    <div class="data-col data-col-end"><span class="data-more" onclick="changeImage()"><em class="icon ni ni-pen"></em></span></div>
                </div>
                <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                    <div class="data-col">
                        <span class="data-label">Full Name</span>
                        <span class="data-value">{{auth()->user()->name}}</span>
                    </div>
                    <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-pen"></em></span></div>
                </div>
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">Email</span>
                        <span class="data-value">{{auth()->user()->email}}</span>
                    </div>
                    <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
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
                        <span class="data-value">
                            @switch(auth()->user()->language)
                                @case('en')
                                🇺🇸 English
                                @break
                                @case('zh')
                                🇨🇳 中文
                                @break
                                @case('ja')
                                🇯🇵 日本語
                                @break
                                @case('ms')
                                🇲🇾 Bahasa Melayu
                                @break
                                @case('ko')
                                🇰🇷 한국어
                                @break
                                @case('vi')
                                🇻🇳 Tiếng Việt
                                @break
                                @case('th')
                                🇹🇭 ภาษาไทย
                                @break
                                @case('id')
                                🇮🇩 Bahasa Indonesia
                                @break
                                @case('ta')
                                🇮🇳 தமிழ்
                                @break
                                @case('tl')
                                🇵🇭 Tagalog
                                @break
                                @default
                                🇺🇸 English
                            @endswitch
                        </span>
                    </div>
                    <div class="data-col data-col-end"><span class="data-more" onclick="changeLanguage()"><em class="icon ni ni-pen"></em></span></div>
                </div>
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">Timezone</span>
                        <span class="data-value">{{auth()->user()->timezone}}</span>
                    </div>
                    <div class="data-col data-col-end"><span class="data-more" onclick="changeTimezone()"><em class="icon ni ni-pen"></em></span></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function changeImage() {
            Swal.fire({
                title: 'Upload a new image',
                input: 'file',
                inputAttributes: {
                    accept: 'image/*',
                    'aria-label': 'Upload your profile picture'
                }
            }).then((file) => {
                if (file.value) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = new Image();
                        img.src = e.target.result;
                        img.onload = () => {
                            const canvas = document.createElement('canvas');
                            const size = Math.min(img.width, img.height);
                            canvas.width = size;
                            canvas.height = size;

                            const ctx = canvas.getContext('2d');
                            ctx.fillStyle = 'white'; // Set the background color to white
                            ctx.fillRect(0, 0, canvas.width, canvas.height); // Fill the canvas with white
                            const x = img.width > img.height ? (img.width - img.height) / 2 : 0;
                            const y = img.height > img.width ? (img.height - img.width) / 2 : 0;

                            ctx.drawImage(img, -x, -y);

                            const resizedCanvas = document.createElement('canvas');
                            resizedCanvas.width = 100;
                            resizedCanvas.height = 100;
                            const resizedCtx = resizedCanvas.getContext('2d');
                            resizedCtx.drawImage(canvas, 0, 0, size, size, 0, 0, 100, 100);
                            const resizedImageUrl = resizedCanvas.toDataURL('image/jpeg');

                            Swal.fire({
                                title: 'Confirm profile image?',
                                imageUrl: resizedImageUrl,
                                imageAlt: 'The uploaded picture',
                                showCancelButton: true,
                                confirmButtonText: 'Save',
                                showLoaderOnConfirm: true,
                                preConfirm: (image) => {
                                    $.ajax({
                                        url: '{{route('admin.account.avatar')}}',
                                        type: 'POST',
                                        data: {
                                            _token: '{{csrf_token()}}',
                                            avatar: resizedImageUrl
                                        },
                                        success: function (response) {
                                            if (response.success) {
                                                Swal.fire('Profile image updated!', '', 'success');
                                                window.location.reload();
                                            } else {
                                                Swal.fire('Error!', response.message, 'error');
                                            }
                                        },
                                        error: function (error) {
                                            Swal.fire('Error!', 'Something went wrong!', 'error');
                                        }
                                    });
                                },
                                allowOutsideClick: () => !Swal.isLoading()
                            });
                        };
                    };
                    reader.readAsDataURL(file.value);
                }
            });
        }

        function changeLanguage() {
            Swal.fire({
                title: 'Preferred Language',
                html: `<div class="form-group center mt-3">
                    <select class="form-select js-select2 tw-w-60" id="language" name="language">
                        <option value="en">🇺🇸 English</option>
                        <option value="zh">🇨🇳 中文</option>
                        <option value="ja">🇯🇵 日本語</option>
                        <option value="ms">🇲🇾 Bahasa Melayu</option>
                        <option value="ms">🇮🇩 Bahasa Indonesia</option>
                        <option value="ko">🇰🇷 한국어</option>
                        <option value="vi">🇻🇳 Tiếng Việt</option>
                        <option value="th">🇹🇭 ภาษาไทย</option>
                    </select>
                </div>`,
                showCancelButton: true,
                confirmButtonText: 'Save',
                onOpen: () => {
                    $('.js-select2').select2();
                },
                preConfirm: () => {
                    const language = $('#language').val();
                    $.ajax({
                        url: '{{route('admin.account.language')}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            language: language
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('Language updated!', '', 'success').then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function (error) {
                            Swal.fire('Error!', 'Something went wrong!', 'error');
                        }
                    });
                }
            });
        }

        function changeTimezone() {
            Swal.fire({
                title: 'Preferred Timezone',
                html: `<div class="form-group center mt-3">
                    <select class="form-select js-select2 tw-w-60" id="timezone" name="timezone">
                        @foreach(timezone_identifiers_list() as $timezone)
                            <option value="{{$timezone}}">{{$timezone}}</option>
                        @endforeach
                    </select>
                </div>`,
                showCancelButton: true,
                confirmButtonText: 'Save',
                onOpen: () => {
                    $('.js-select2').select2();
                    $('.select2-dropdown').css('z-index', 9999999999)
                },
                preConfirm: () => {
                    const timezone = $('#timezone').val();
                    $.ajax({
                        url: '{{route('admin.account.timezone')}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            timezone: timezone
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire('Timezone updated!', '', 'success').then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function (error) {
                            Swal.fire('Error!', 'Something went wrong!', 'error');
                        }
                    });
                }
            });
        }
    </script>
@endpush

