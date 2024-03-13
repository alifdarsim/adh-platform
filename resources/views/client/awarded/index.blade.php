@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content d-flex tw-items-center">
                <a href="{{ route('expert.projects.index') }}" class="back-to"><em
                        class="icon ni ni-arrow-left text-dark fs-3 pe-2"></em></a>
                <h3 class="nk-block-title page-title">Project Details</h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="tw-gap-4">
            <div class="card px-4 pb-3">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#detail">
                            <i class="fa-regular fa-memo-circle-info me-1"></i><span>Detail</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#meeting" id="meetingLink">
                            <i class="fa-regular fa-handshake-simple me-1"></i><span>Meeting</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#chatLink">
                            <i class="fa-regular fa-messages me-1"></i><span>Chat</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#contract">
                            <i class="fa-regular fa-file-signature me-1"></i><span>Contract</span></a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" data-bs-toggle="tab" href="#payment">--}}
{{--                            <i class="fa-regular fa-money-bill me-1"></i><span>Payment</span></a>--}}
{{--                    </li>--}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="detail">
                        @include('client.awarded._details')
                    </div>
                    <div class="tab-pane" id="meeting">
                        @include('client.awarded._meeting')
                    </div>
                    <div class="tab-pane" id="chatLink">
                        @include('client.awarded._chat')
                    </div>
                    <div class="tab-pane" id="contract">
                        @include('client.awarded._contract')
                    </div>
{{--                    <div class="tab-pane" id="payment">--}}
{{--                        @include('client.awarded._payment')--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script>
        //fake swal to looks like the user login
        @if(session()->has('message'))
            console.log('asdasda');
        _Swal.loadingCallback('Logged In User...', 'Please wait', 1000, function () {
            Swal.fire({
                title: 'Logged In Success',
                text: 'You are now logged in',
                icon: 'success',
                timer: 1000,
                showCancelButton: false,
                showConfirmButton: false
            });
        });
        @endif

    </script>
@endpush
