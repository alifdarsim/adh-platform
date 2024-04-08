@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a class="back" href="{{route('expert.projects.index')}}"><i
                            class="fa-solid fa-arrow-left me-2 fs-4"></i></a>{{$project->name}}</h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        @include('status.index')

        @if($project_expert->status == 'shortlisted')
            @include('expert.project.show.shortlist')
        @elseif ($project_expert->status == 'ongoing')
            @include('expert.project.show.award')
        @endif
{{--        @if ($project->status == 'shortlisted')--}}
{{--            @include('expert.project.show.shortlist')--}}
{{--            @include('expert.project.show.award')--}}
{{--            @include('expert.project.show.contract')--}}
{{--        @elseif($project->status == 'awarded')--}}
{{--            @include('expert.project.show.award')--}}
{{--        @elseif($project->status == 'contract')--}}
{{--            @include('expert.project.show.contract')--}}
{{--        @elseif($project->status == 'started')--}}
{{--            @include('expert.project.show.start')--}}
{{--        @endif--}}

        @include('admin.projects.show.show-detail')
    </div>

    <div class="modal fade" id="modalEnquiries">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Answer Client Enquiries</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    @foreach($project->questions as $question)
                        <div class="form-group">
                            <label class="form-label fs-15px" for="q{{($loop->index)+1}}">Q{{($loop->index)+1}}: {{$question}}</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="a{{($loop->index)+1}}" value="{{($project->answered() == null ? '' : ($project->answered()->answers)[$loop->index]) }}" placeholder="">
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex">
                        <a onclick="submitQuestions()" class="btn btn-primary px-5 me-2">Submit Question</a>
                        <a data-bs-dismiss="modal" class="btn btn-light px-5">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="/assets/js/libs/tagify.js?ver=3.2.2"></script>
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script>
        let tagsElement;
        $(document).ready(function () {
            $('#communication_language').val({!! collect($project->projectTargetInfo->communication_language)->map(fn($item) =>  $item )->implode(',') !!}).trigger('change');
            $('#target_keyword').tagify().data('tagify').addTags('{{$project->keywords->pluck('name')->implode(',  ')}}');
            tagsElement = $('.tagify').tagify();
        });
    </script>
@endpush

{{--@extends('layouts.user.main')--}}
{{--@section('content')--}}

{{--    <div class="nk-block-head nk-block-head-sm">--}}
{{--        <div class="nk-block-between">--}}
{{--            <div class="nk-block-head-content d-flex tw-items-center">--}}
{{--                <a href="{{ route('expert.projects.index') }}" class="back-to"><em class="icon ni ni-arrow-left text-dark fs-3 pe-2"></em></a>--}}
{{--                <h3 class="nk-block-title page-title">Projects Details</h3>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="nk-block">--}}
{{--        <div class="tw-grid tw-grid-cols-4 tw-gap-4">--}}
{{--            <div class="tw-col-span-3">--}}
{{--                <div class="alert alert-pro alert-info py-2 tw-grid tw-grid-cols-1 tw-divide-y">--}}
{{--                    <div class="d-flex">--}}
{{--                        <p class="tw-font-semibold tw-text-gray-700 me-2 mb-0 pt-1 fs-16px">Invitation Status:</p>--}}
{{--                        @if($project->invited_user_accepted())--}}
{{--                            <div>--}}
{{--                                <a class="tw-cursor-default btn btn-success">--}}
{{--                                    <em class="d-none d-sm-inline icon ni ni-check me-1"></em>Invitation Accepted--}}
{{--                                </a>--}}
{{--                                <div class="alert alert-success mt-2">--}}
{{--                                    <p>Expert selection is in progress. You will be notified through email once the client selects you.</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @else--}}
{{--                            <div class="drodown">--}}
{{--                                <a href="#" id="invitation_status" class="dropdown-toggle btn {{$project->invited_user_accepted() ? 'btn-success' : ($project->invited_user_accepted() === false ? 'btn-secondary' : 'btn-primary btn-dim')}}" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                    <span>{{$project->invited_user_accepted() ? 'Accepted' : ($project->invited_user_accepted() === false ? 'Declined' : 'No Respond Yet')}}</span><em class="dd-indc icon ni ni-chevron-down"></em>--}}
{{--                                </a>--}}
{{--                                <div class="dropdown-menu dropdown-menu-end" style="">--}}
{{--                                    <ul class="link-list-opt no-bdr">--}}
{{--                                        <li><a class="clickable" onclick="respond('{{$project->pid}}', true)"><em class="d-none d-sm-inline icon ni ni-check"></em><span>Accept Invitation</span></a></li>--}}
{{--                                        <li><a class="clickable" onclick="respond('{{$project->pid}}', false)"><em class="d-none d-sm-inline icon ni ni-cross"></em><span>Reject Invitation</span></a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="border my-3"></div>--}}
{{--                    @dd($project->answered()->answers)--}}
{{--                    <div class="pb-2">--}}
{{--                        <div class="alert alert-secondary">--}}
{{--                            <p>* To be rank high in the selection process, you may want to answer several enquiries from the client. This will help the client to understand your expertise and experience in the field.</p>--}}
{{--                            <div class="d-flex">--}}
{{--                                <p class="tw-font-semibold tw-text-gray-700 me-2 mb-0 pt-1 fs-16px">Client Questions Answered: {{count(array_filter($project->answered() == null ? [] : $project->answered()->answers ))}} / {{count($project->questions)}}</p>--}}
{{--                                <a onclick="answerEnquiries()" class="btn btn-primary btn-sm mt-1">Answer Enquiries</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <div class="card px-3 py-2">--}}
{{--                    <h6 class="tw-font-semibold tw-text-gray-700 tw-mb-2 mt-1">About Client</h6>--}}
{{--                    <div class="tw-w-full">--}}
{{--                        <div class="mb-1 d-flex"><span class="tw-w-8 tw-flex tw-items-center tw-justify-center"><i class="fa-regular fa-building"></i></span>{{$project->company->name}}</div>--}}
{{--                        <div class="mb-1 d-flex"><span class="tw-w-8 tw-flex tw-items-center tw-justify-center"><i class="fa-solid fa-location-dot"></i></span>{{$project->company->address->emoji ?? '-'}} {{$project->company->address->country ?? 'Not Disclosed'}}</div>--}}
{{--                        <div class="mb-1 d-flex"><span class="tw-w-8 tw-flex tw-items-center tw-justify-center"><i class="fa-regular fa-globe"></i></span><a class="text-info" href="{{$project->client->website ?? '#'}}">{{$project->company->website ?? 'No website'}}</a></div>--}}
{{--                        <div class="mb-1 d-flex"><span class="tw-w-8 tw-flex tw-items-center tw-justify-center"><i class="fa-regular fa-person"></i></span>{{$project->company->company_size ?? '-'}} employee</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        <div class="card px-4 mt-2 py-3">--}}
{{--            <div class="tw-flex tw-justify-between">--}}
{{--                <p class="sub-text mb-2" style="text-transform: uppercase;"><i class="fa-solid fa-clock fs-11px me-1"></i> PUBLISH AT: {{ formatDate($project->published_at) }}</p>--}}
{{--                <p class="sub-text" style="text-transform: uppercase;"><i class="fa-solid fa-clock fs-11px me-1"></i> EXPERT SELECTION DUE DATE: {{ formatDate($project->deadline) }}</p>--}}
{{--            </div>--}}
{{--            <div class="d-flex">--}}
{{--                <h4 class="my-0 tw-text-3xl">Title: {{$project->name}}</h4>--}}
{{--            </div>--}}
{{--            <div class="tw-container tw-mx-auto">--}}
{{--                <p class="mb-0 mt-2 fs-15px">Hub Types: <span>{{$project->hub->name}}</span></p>--}}
{{--                <div class="tw-flex tw-justify-between my-2">--}}
{{--                    <p class="mb-0">Tags: @foreach($project->keywords as $keyword)--}}
{{--                            <span class="badge bg-outline-info border-2 tw-rounded-full tw-capitalize fs-12px tw-font-medium px-2 tw-py-0.5">{{$keyword->name}}</span>--}}
{{--                        @endforeach</p>--}}
{{--                </div>--}}
{{--                <div class="my-1">--}}
{{--                    <p class="tw-text-slate-600 fs-13px">{!! nl2br(e($project->description)) !!}</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tw-flex tw-justify-between mt-3">--}}
{{--                <p class="mb-0">Projects ID: #{{$project->pid}}</p>--}}
{{--                <p onclick="reportProject()" class="fs-12px tw-cursor-pointer hover:tw-text-red-700"><i class="fa-solid fa-flag me-1"></i> Report Projects</p>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--    <div class="modal fade" id="modalReport">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title">Help us understand what's happening</h5>--}}
{{--                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                        <em class="icon ni ni-cross"></em>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form action="#" class="form-validate is-alter">--}}
{{--                        <h6 class="mb-2">What are you reporting for?</h6>--}}
{{--                        <div class="form-group mb-2">--}}
{{--                            <div class="custom-control custom-radio">--}}
{{--                                <input type="radio" id="report1" name="customRadio" value="Contains contact information" class="custom-control-input">--}}
{{--                                <label class="custom-control-label" for="report1">Contains contact information</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-2">--}}
{{--                            <div class="custom-control custom-radio">--}}
{{--                                <input type="radio" id="report2" name="customRadio" value="Fake project posted" class="custom-control-input">--}}
{{--                                <label class="custom-control-label" for="report2">Fake project posted</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-2">--}}
{{--                            <div class="custom-control custom-radio">--}}
{{--                                <input type="radio" id="report3" name="customRadio" value="Advertising another website" class="custom-control-input">--}}
{{--                                <label class="custom-control-label" for="report3">Advertising another website</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-2">--}}
{{--                            <div class="custom-control custom-radio">--}}
{{--                                <input type="radio" id="report4" name="customRadio" value="Obscenities or harassing behaviour" class="custom-control-input">--}}
{{--                                <label class="custom-control-label" for="report4">Obscenities or harassing behaviour</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group mb-2">--}}
{{--                            <div class="custom-control custom-radio">--}}
{{--                                <input type="radio" id="report5" name="customRadio" value="Others" class="custom-control-input">--}}
{{--                                <label class="custom-control-label" for="report5">Others</label>--}}
{{--                            </div>--}}
{{--                            <textarea class="form-control mt-2" id="other_textarea" rows="3" placeholder="Specify a reason if necessary"></textarea>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex justify-end">--}}
{{--                            <a href="#" data-bs-dismiss="modal" class="btn btn-light me-2">Cancel</a>--}}
{{--                            <a onclick="reportProjects()" class="btn btn-primary">Report</a>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @dd($project->answered())--}}

{{--    <div class="modal fade" id="modalEnquiries">--}}
{{--        <div class="modal-dialog modal-lg" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title">Answer Client Enquiries</h5>--}}
{{--                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                        <em class="icon ni ni-cross"></em>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    @foreach($project->questions as $question)--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="form-label fs-15px" for="q{{($loop->index)+1}}">Q{{($loop->index)+1}}: {{$question}}</label>--}}
{{--                            <div class="form-control-wrap">--}}
{{--                                <input type="text" class="form-control" id="a{{($loop->index)+1}}" value="{{($project->answered() == null ? '' : ($project->answered()->answers)[$loop->index]) }}" placeholder="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                    <div class="d-flex">--}}
{{--                        <a onclick="submitQuestions()" class="btn btn-primary px-5 me-2">Submit Question</a>--}}
{{--                        <a data-bs-dismiss="modal" class="btn btn-light px-5">Cancel</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--@endsection--}}

{{--@push('scripts')--}}
{{--    <script>--}}

{{--        function respond(pid, accept){--}}
{{--            Swal.fire({--}}
{{--                title: `${accept ? 'Accept' : 'Reject'} Invitation?`,--}}
{{--                text: `You want to ${accept ? 'show interest' : 'reject'} on this project?`,--}}
{{--                icon: 'warning',--}}
{{--                showCancelButton: true,--}}
{{--                confirmButtonText: 'Yes, I am sure!',--}}
{{--                cancelButtonText: 'No, cancel it!',--}}
{{--            }).then((result) => {--}}
{{--                if (result.isConfirmed) {--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ route('expert.projects.respond')}}",--}}
{{--                        type: 'POST',--}}
{{--                        data: {--}}
{{--                            _token: '{{csrf_token()}}',--}}
{{--                            pid: pid,--}}
{{--                            respond: accept--}}
{{--                        },--}}
{{--                        success: function (response) {--}}
{{--                            if (response.accepted) $('#invitation_status').removeClass('btn-primary btn-dim btn-success btn-secondary').addClass('btn-success').text('Accepted');--}}
{{--                            else $('#invitation_status').removeClass('btn-primary btn-dim btn-success btn-secondary').addClass('btn-secondary').text('Declined');--}}
{{--                            Swal.fire({--}}
{{--                                title: response.accepted ? 'Shortlisted Success' : 'Reject Success',--}}
{{--                                html: response.message,--}}
{{--                                icon: 'success',--}}
{{--                                confirmButtonText: 'Answer Client Questions',--}}
{{--                                showCancelButton: true,--}}
{{--                                cancelButtonText: 'Will Answer Later'--}}
{{--                            }).then((result) => {--}}
{{--                                if (result.isConfirmed) answerEnquiries();--}}
{{--                            })--}}
{{--                        },--}}
{{--                        error: function (error) {--}}
{{--                            Swal.fire('Error', error.responseJSON.message, 'error');--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            })--}}
{{--        }--}}

{{--        function reportProject(){--}}
{{--            $('#modalReport').modal('show');--}}
{{--        }--}}

{{--        function reportProjects(){--}}
{{--            // get selected radio button id--}}
{{--            let selected = $('input[name="customRadio"]:checked').val();--}}
{{--            $.ajax({--}}
{{--                url: "{{ route('expert.projects.report')}}",--}}
{{--                type: 'POST',--}}
{{--                data: {--}}
{{--                    _token: "{{ csrf_token() }}",--}}
{{--                    pid: "{{ $project->pid }}",--}}
{{--                    reason: selected,--}}
{{--                    detail: $('#other_textarea').val()--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    Swal.fire({--}}
{{--                        title: 'Thank you for reporting',--}}
{{--                        text: response.message,--}}
{{--                        icon: 'success',--}}
{{--                        confirmButtonColor: '#5cb85c',--}}
{{--                        confirmButtonText: 'Ok'--}}
{{--                    }).then((result) => {--}}
{{--                        if (result.isConfirmed) {--}}
{{--                            $('#modalReport').modal('hide');--}}
{{--                        }--}}
{{--                    })--}}
{{--                },--}}
{{--                error: function (response) {--}}
{{--                    Swal.fire({--}}
{{--                        title: 'Error!',--}}
{{--                        text: response.responseJSON.message,--}}
{{--                        icon: 'error',--}}
{{--                        confirmButtonColor: '#5cb85c',--}}
{{--                        confirmButtonText: 'Ok'--}}
{{--                    })--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        $( document ).ready(function() {--}}
{{--            $('a[href$="{{route('expert.projects.index')}}"]').parent().addClass('active');--}}
{{--        });--}}

{{--        function answerEnquiries(){--}}
{{--            $('#modalEnquiries').modal('show');--}}
{{--        }--}}

{{--        function submitQuestions(overwrite = false){--}}
{{--            let answers = [];--}}
{{--            @foreach($project->questions as $question)--}}
{{--                answers.push($('#a{{($loop->index)+1}}').val());--}}
{{--            @endforeach--}}
{{--            $.ajax({--}}
{{--                url: "{{ route('expert.projects.answer-enquiries')}}",--}}
{{--                type: 'POST',--}}
{{--                data: {--}}
{{--                    _token: "{{ csrf_token() }}",--}}
{{--                    pid: "{{ $project->pid }}",--}}
{{--                    answers: answers,--}}
{{--                    overwrite: overwrite--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    Swal.fire({--}}
{{--                        title: 'Thank you for answering',--}}
{{--                        html: response.message,--}}
{{--                        icon: 'success',--}}
{{--                        confirmButtonColor: '#5cb85c',--}}
{{--                        confirmButtonText: 'Ok'--}}
{{--                    }).then((result) => {--}}
{{--                        location.reload();--}}
{{--                    })--}}
{{--                },--}}
{{--                error: function (response) {--}}
{{--                    console.log(response);--}}
{{--                    let answered = response.responseJSON.answered;--}}
{{--                    if (answered) {--}}
{{--                        Swal.fire({--}}
{{--                            title: 'Already Answered',--}}
{{--                            html: response.responseJSON.message,--}}
{{--                            icon: 'warning',--}}
{{--                            confirmButtonColor: '#5cb85c',--}}
{{--                            confirmButtonText: 'Override Answer',--}}
{{--                            cancelButtonText: 'Cancel',--}}
{{--                            showCancelButton: true--}}
{{--                        }).then((result) => {--}}
{{--                            if (result.isConfirmed) {--}}
{{--                                submitQuestions(true);--}}
{{--                            }--}}
{{--                        })--}}
{{--                    } else {--}}
{{--                        _Swal.error(response.responseJSON.message);--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}


{{--    </script>--}}
{{--@endpush--}}
