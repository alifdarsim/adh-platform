@extends('layouts.others.main')
@section('content')

    <x-content_header title="Hi! {{ auth()->user()->name }}" subtitle="Welcome to AsiaDealHub Dashboard."/>

    <div class="nk-block">
        <div class="tw-grid tw-grid-cols-4 tw-gap-x-4">
            <div class="bg-primary tw-rounded">
                <div class="card-inner tw-shadow">
                    <div class="nk-iv-wg2-title">
                        <h6 class="tw-text-slate-100">Pending Approval <em class="icon ni ni-info"></em></h6>
                    </div>
                    <div class="mt-1">
                        <div class="tw-text-slate-50 tw-text-4xl">1</div>
                    </div>
                </div>
            </div>
            <div class="tw-bg-white tw-rounded">
                <div class="card-inner tw-shadow">
                    <div class="nk-iv-wg2-title">
                        <h6 class="tw-text-slate-600">Ongoing Project <em class="icon ni ni-info"></em></h6>
                    </div>
                    <div class="mt-1">
                        <div class="tw-text-slate-500 tw-text-4xl">3</div>
                    </div>
                </div>
            </div>
            <div class="tw-bg-white tw-rounded">
                <div class="card-inner tw-shadow">
                    <div class="nk-iv-wg2-title">
                        <h6 class="tw-text-slate-600">Complete Project<em class="icon ni ni-info"></em></h6>
                    </div>
                    <div class="mt-1">
                        <div class="tw-text-slate-500 tw-text-4xl">5</div>
                    </div>
                </div>
            </div>
            <div class="tw-bg-white tw-rounded">
                <div class="card-inner tw-shadow">
                    <div class="nk-iv-wg2-title">
                        <h6 class="tw-text-slate-600">Earning <em class="icon ni ni-info"></em></h6>
                    </div>
                    <div class="mt-1">
                        <div class="tw-text-slate-500 tw-text-4xl">$233</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
