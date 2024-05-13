@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">
                    Welcome {{auth()->user()->name ?? 'to Asia Deal Hub!'}}</h3>
                <div class="nk-block-des text-soft"><p>Monitor all your expert activity from this expert dashboard</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="tw-grid tw-grid-cols-3 tw-gap-x-4">
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Ongoing Projects</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                            data-bs-placement="left"
                            data-bs-original-title="Current ongoing project">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data">
                        <span class="tw-text-4xl text-dark">
                            {{$project_expert->where('status', 'ongoing')->count()}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Completed Projects</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                            data-bs-placement="left"
                            data-bs-original-title="Current completed project">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data">
                        <span class="tw-text-4xl text-dark">
                            {{$project_expert->where('status', 'completed')->count()}}
                        </span>
                    </div>
                </div>
            </div>
            <div class="card card-bordered p-4">
                <div class="card-title-group align-start mb-2">
                    <div class="card-title">
                        <h6 class="title">Total Projects</h6>
                    </div>
                    <div class="card-tools">
                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                            data-bs-placement="left"
                            data-bs-original-title="Total project completed">
                        </em>
                    </div>
                </div>
                <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                    <div class="nk-sale-data">
                        <span class="tw-text-4xl text-dark">
                            {{$project_expert->whereIn('status', ['completed', 'ongoing'])->count()}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <h5 class="nk-block-title">Expert Information</h5>
        </div>
        <div class="row g-gs">
            <div class="col-lg-7">
                <div class="card card-bordered card-full">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Latest Project Status</h6>
                                </div>
                                <div class="card-tools">
                                    <a href="{{route('expert.projects.index')}}" class="link">View All</a>
                                </div>
                            </div>
                        </div>
                        @if($project_expert->count() > 0)
                            @foreach($project_expert->take(3) as $project)
                                <div class="card-inner card-inner-md">
                                    <div class="user-card d-flex justify-between">
                                        <a href="{{route('expert.projects.show', $project->project->pid)}}" class="user-info">
                                            <span class="tw-text-slate-600">
                                                <i class="fa-solid fa-circle-small text-danger me-1"></i>
                                                <span>{{$project->project->name}}</span>
                                            </span>
                                        </a>
                                        <div class="user-action ms-1">
                                            <div class="badge rounded-pill bg-{{$project->status == 'complete' ? 'success' : ($project->status == 'ongoing' ? 'warning' : 'secondary')}} badge-sm text-capitalize">
                                                {{$project->status}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="card-inner card-inner-md">
                                <div class="user-card mx-auto center tw-items-center">
                                    <div class="user-info">
                                        <span class="tw-text-slate-600 tw-items-center center mx-auto">
                                            <span>You don't have any projects yet</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div><!-- .col -->
{{--            <div class="col-lg col-sm-6">--}}
{{--                <div class="card card-bordered h-100">--}}
{{--                    <div class="card-inner border-bottom">--}}
{{--                        <div class="card-title-group">--}}
{{--                            <div class="card-title">--}}
{{--                                <h6 class="title">Upcoming Meetings</h6>--}}
{{--                            </div>--}}
{{--                            <div class="card-tools">--}}
{{--                                <a href="#" class="link">View All</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="card-inner">--}}
{{--                        <span class="tw-text-slate-600 tw-items-center center mx-auto">--}}
{{--                            <span>You don't have any schedule meeting</span>--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- .col -->--}}
            <div class="col-lg col-sm-5">
                <div class="card card-bordered h-100">
                    <div class="card-inner justify-center text-center h-100">
                        <div class="nk-iv-wg5">
                            <div class="nk-iv-wg5-head">
                                <h5 class="nk-iv-wg5-title">Profile Completion</h5>
                                <a href="{{route('expert.profile.index')}}"><span
                                        class="tw-font-medium">View Completion</span></a>
                            </div>
                            <div class="nk-iv-wg5-ck sm">
                                <input type="text" class="knob-half" value="{{round($expert_completion_count/6*100)}}" data-fgColor="#e85347"
                                       data-bgColor="#d9e5f7" data-thickness=".07" data-width="240"
                                       data-height="125" data-displayInput="false">
                                <div class="nk-iv-wg5-ck-result">
                                    <div class="text-lead sm">{{round($expert_completion_count/6*100) }}%</div>
                                    <div class="text-sub fs-16px">{{$expert_completion_count}}/6 Complete</div>
                                </div>
                                <div class="nk-iv-wg5-ck-minmax"><span>0</span><span>6</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .nk-block -->

    <div class="modal fade" tabindex="-1" role="dialog" id="modal_expert_completion">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-md">
                    <h4 class="title center">Welcome to Asia Deal Hub!</h4>
                    <div class="px-5">
                        <p class="mt-3 mb-0 fs-6 tw-text-center">Look like that you are new to AsiaDealHub. In order to start using AsiaDealHub, lets complete your expert profile first.</p>
                        <div class="center mt-4">
                            <button onclick="goToExpertCompletion()" class="btn btn-primary tw-px-36">Go To Expert Completion</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="modal fade" tabindex="-1" role="dialog" id="modal_expert_completion2">--}}
{{--        <div class="modal-dialog modal-lg" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body modal-body-md">--}}
{{--                    <h4 class="title center">First time here?</h4>--}}
{{--                    <div class="px-5">--}}
{{--                        <p class="mt-3 mb-0 fs-6 tw-text-center">Look like that you are new this AsiaDealHub. In order to start using AsiaDealHub, you need to complete your expert profile. This will help us to match you with the right clients and projects.</p>--}}
{{--                        <div class="center mt-4">--}}
{{--                            <button onclick="goToExpertCompletion()" class="btn btn-primary tw-px-36">Go To Expert Completion</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection

@push('scripts')
    <script>
        $( document ).ready(function() {
{{--            @if(!auth()->user()->isHasExpert())--}}
{{--                let modal = $('#modal_expert_completion');--}}
{{--                modal.modal({backdrop: 'static', keyboard: false})--}}
{{--                modal.modal('show');--}}
{{--            @endif--}}
        });

        function goToExpertCompletion(){
            window.location.href = "{{route('expert.profile.index')}}";
        }
    </script>
@endpush
