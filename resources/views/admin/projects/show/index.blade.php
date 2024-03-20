@push('scripts')
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>
    <script src="/assets/js/libs/tagify.js?ver=3.2.2"></script>
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
@endpush
@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    <a class="back" href="{{route('admin.projects.index')}}"><i
                            class="fa-solid fa-arrow-left me-2 fs-4"></i></a>
                    {{$project->name}}
                </h3>
            </div>
{{--            <div class="nk-block-head-content">--}}
{{--                <div class="toggle-wrap nk-block-tools-toggle">--}}
{{--                    <div class="toggle-expand-content" data-content="pageMenu">--}}
{{--                        <ul class="nk-block-tools g-3">--}}
{{--                            <li>--}}
{{--                                <div class="dropdown">--}}
{{--                                    <a href="#" class="dropdown-toggle btn btn-primary" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                        <span>Views</span>--}}
{{--                                        <em class="d-none d-sm-inline icon ni ni-chevron-right"></em>--}}
{{--                                    </a>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-end" style="">--}}
{{--                                        <ul class="link-list-opt no-bdr">--}}
{{--                                            <li><a href="#"><span>Last 30 Days</span></a></li>--}}
{{--                                            <li><a href="#"><span>Last 6 Months</span></a></li>--}}
{{--                                            <li><a href="#"><span>Last 1 Years</span></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
    <div class="nk-block">
        @include('status.index')

        @if($project->payment && $project->payment->where('received_status', 'pending')->first())
            <div class="nk-block-head-content mt-3">
                <h6 class="title pb-1">Pending Action from Client</h6>
            </div>
            <div class="example-alert mb-3">
                <div class="alert alert-fill bg-warning-dim alert-icon border !tw-border-yellow-500">
                    <em class="icon ni ni-money"></em>
                    <p class="mb-1">Client yet to pay the amount of <strong>{{$project->payment->where('received_status', 'pending')->first()->received_amount}}</strong> agreed upon this project. Make sure to received payment before closing the project.</p>
                </div>
            </div>
        @elseif($project->payment && $project->payment->where('received_status', 'pending_verification')->first())
            <div class="nk-block-head-content mt-3">
                <h6 class="title pb-1">Pending Action from Client</h6>
            </div>
            <div class="example-alert mb-3">
                <div class="alert alert-fill bg-success-dim alert-icon border !tw-border-green-500">
                    <em class="icon ni ni-money"></em>
                    <p class="mb-1">Client have made payment of amount <strong>{{$project->payment->where('received_status', 'pending_verification')->first()->received_amount}}</strong>. Please verify and confirm the payment transaction is successful.</p>
                    <a href="{{route('admin.payment.index')}}" class="btn btn-primary">Verify Payment</a>
                </div>
            </div>
        @endif

        @if($project->status == 'pending')
            @include('admin.projects.show.approve')
        @elseif ($project->status == 'shortlisted')
            @include('admin.projects.show.expert_search')
            @include('admin.projects.show.shortlist')
            @include('admin.projects.show.modal-expert-detail')
        @elseif($project->status == 'awarded')
            @include('admin.projects.show.award')
            @include('admin.projects.show.modal-expert-detail')
        @elseif($project->status == 'contract')
            @include('admin.projects.show.contract')
        @elseif($project->status == 'started')
            @include('admin.projects.show.start')
        @elseif($project->status == 'payment')
            @include('admin.projects.show.payment')
        @endif
        @include('admin.projects.show.show-detail')
    </div>

@endsection

