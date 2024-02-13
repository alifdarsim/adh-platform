@extends('layouts.others.main')
@section('content')
    <style>
        #item-center {
            display: grid;
            place-items: center;
            height: 100vh; /* Make sure the container takes the full height of the viewport */
            margin: 0; /* Remove default margin */
        }
    </style>
    <div class="nk-block nk-block-middle wide-md mx-auto" id="item-center">
        <div class="nk-block-content nk-error-ld text-center">
            <div>
                <img class="email-logo mb-5" src="{{config('app.url') . '/images/logo-dark.png'}}" alt="logo">
            </div>
            <img class="nk-error-gfx w-60 pb-4" src="/images/svg/questioning.svg" alt="">
            <div class="wide-xs mx-auto"><h3 class="nk-error-title">Uninvited Project</h3>
                <p class="nk-error-text">We are very sorry for inconvenience. But you are not invited to this project or
                    you are not authorized to access this page.</p>
                <a href="{{config('app.url')}}" class="btn btn-lg btn-danger mt-2">
                    Go To Home
                </a>
            </div>
        </div>
    </div>
@endsection
