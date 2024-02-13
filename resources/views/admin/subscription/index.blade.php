@extends('layouts.others.main')
@section('content')

    @php
        $packages = [
            [
                'name' => 'ADH Basic',
                'price' => '$99.00',
                'access' => '1 Year'
            ],
            [
                'name' => 'ADH Standard',
                'price' => '$149.00',
                'access' => '1 Year'
            ],
            [
                'name' => 'ADH Premium',
                'price' => '$199.00',
                'access' => '2 Year'
            ],
            [
                'name' => 'ADH Enterprise',
                'price' => '$599.00',
                'access' => 'Unlimited'
            ]
        ]
    @endphp

    <x-content_header title="ADH Subscription Package"
                      subtitle="A list of ADH package to for the user to subscribe upon."/>

    <div class="row g-3">

        @foreach($packages as $package)

            <div class="col-6">
                <div class="card card-bordered">
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="sp-plan-info card-inner">
                                <div class="row gx-0 gy-3">
                                    <div class="col-xl-9 col-sm-8">
                                        <div class="sp-plan-name">
                                            <h6 class="title">
                                                <a href="/demo4/subscription/subscriptions-detail.html">
                                                    <span class="fs-22px">{{$package['name']}}</span>
                                                    <span class="badge bg-success rounded-pill">Active</span>
                                                </a>
                                            </h6>
                                            <p>Subscription ID: <span class="text-base">100394949</span></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-sm-4">
                                        <div class="sp-plan-opt d-flex justify-content-end">
                                            <a class="btn btn-primary"><i
                                                        class="fa-solid fa-pen-to-square me-2 fs-6"></i> Edit</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sp-plan-desc card-inner pt-2">
                                <ul class="row gx-1">
                                    <li class="col-3">
                                        <p class="text-soft mb-0">Started On</p>
                                        <p>Oct 12, 2018</p>
                                    </li>
                                    <li class="col-3">
                                        <p class="text-soft mb-0">Recuring</p>
                                        <p>Yes</p>
                                    </li>
                                    <li class="col-3">
                                        <p class="text-soft mb-0">Price</p>
                                        <p>{{$package['price']}}</p>
                                    </li>
                                    <li class="col-3">
                                        <p class="text-soft mb-0">Access</p>
                                        <p>{{$package['access']}}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{--                        <div class="col-md-4">--}}
                        {{--                            <div class="sp-plan-action card-inner bg-light h-100 d-flex align-items-center justify-content-center">--}}
                        {{--                                <div class="sp-plan-btn text-center">--}}
                        {{--                                    <a class="btn btn-primary" data-bs-toggle="modal" href="#subscription-change">--}}
                        {{--                                        <span>Change Plan</span></a>--}}
                        {{--                                    <div class="sp-plan-note text-md-center mt-1"><p>Next Billing on <span>Oct 11, 2020</span></p></div>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>

        @endforeach

    </div>

@endsection

@push('scripts')
    <script>

    </script>
@endpush
