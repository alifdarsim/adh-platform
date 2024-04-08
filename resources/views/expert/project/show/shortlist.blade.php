<div class="nk-block-head-content mt-3">
    <h6 class="title pb-1">Current Project Status: Expert shortlisting</h6>
</div>
@if($project_expert->accepted)
    <div class="pb-2">
        <div class="alert alert-fill bg-info-dim border !tw-border-blue-500">
            <p>You have been invited to project entitled '<strong>{{$project->name}}</strong>'. Please respond to the invitation to proceed further.</p>
            <div class="d-flex">
                <h6 class="me-3 pt-1">Your respond: </h6>
                <div>
                    <a class="tw-cursor-default btn btn-success">
                        <em class="d-none d-sm-inline icon ni ni-check-circle-fill me-1"></em>Invitation Accepted
                    </a>
                    <div class="alert alert-success mt-2">
                        <p>Expert selection is in progress. You will be notified through email once the client selects you.</p>
                    </div>
                </div>
            </div>
            <div class="border my-2"></div>
            <p class="mb-0">* To be rank high in the selection process, you may want to answer enquiries from the client. This will help the client to understand your expertise and experience in the field.</p>
            <div class="d-flex">
                <h6 class="me-2 mb-0 pt-3">Client Questions: </h6>
                <a onclick="answerEnquiries()" class="btn btn-{{count(array_filter($project->answered() == null ? [] : $project->answered()->answers )) === count($project->questions) ? 'success' : 'danger' }} mt-1">Answer Enquiries | ({{count(array_filter($project->answered() == null ? [] : $project->answered()->answers ))}}/{{count($project->questions)}}) Answered</a>
            </div>
        </div>
    </div>
@else
    <div class="pb-2">
        <div class="alert alert-fill bg-info-dim border !tw-border-blue-500">
            <p>You have been invited to project entitled '<strong>{{$project->name}}</strong>'. Please respond to the invitation to proceed further.</p>
            <div class="d-flex">
                <h6 class="me-3 pt-1">Your respond: </h6>
                <div class="drodown pb-1">
                    <a href="#" id="invitation_status" class="dropdown-toggle btn {{$project->invited_user_accepted() ? 'btn-success' : ($project->invited_user_accepted() === false ? 'btn-secondary' : 'btn-primary btn-dim')}}" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{$project->invited_user_accepted() ? 'Accepted' : ($project->invited_user_accepted() === false ? 'Declined' : 'No Respond Yet')}}</span><em class="dd-indc icon ni ni-chevron-down"></em>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        <ul class="link-list-opt no-bdr">
                            <li><a class="clickable" onclick="respond('{{$project->pid}}', true)"><em class="d-none d-sm-inline icon ni ni-check"></em><span>Accept Invitation</span></a></li>
                            <li><a class="clickable" onclick="respond('{{$project->pid}}', false)"><em class="d-none d-sm-inline icon ni ni-cross"></em><span>Reject Invitation</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="border my-2"></div>
            <p class="mb-0">* To be rank high in the selection process, you may want to answer enquiries from the client. This will help the client to understand your expertise and experience in the field.</p>
            <div class="d-flex">
                <h6 class="me-2 mb-0 pt-3">Client Questions: </h6>
                <a class="btn btn-primary mt-1 disabled">Answer Enquiries | ({{count(array_filter($project->answered() == null ? [] : $project->answered()->answers ))}}/{{count($project->questions)}}) Answered</a>
            </div>
        </div>
    </div>

@endif

@push('scripts')
    <script>
        function respond(pid, accept){
            Swal.fire({
                title: `${accept ? 'Accept' : 'Reject'} Invitation?`,
                text: `You want to ${accept ? 'show interest' : 'reject'} on this project?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: 'Don\'t respond yet',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('expert.projects.respond')}}",
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            pid: pid,
                            respond: accept
                        },
                        success: function (response) {
                            if (response.accepted) $('#invitation_status').removeClass('btn-primary btn-dim btn-success btn-secondary').addClass('btn-success').text('Accepted');
                            else $('#invitation_status').removeClass('btn-primary btn-dim btn-success btn-secondary').addClass('btn-secondary').text('Declined');
                            Swal.fire({
                                title: response.accepted ? 'Shortlisted Success' : 'Reject Success',
                                html: response.message,
                                icon: 'success',
                                confirmButtonText: 'Answer Client Questions',
                                showCancelButton: true,
                                cancelButtonText: 'Will Answer Later'
                            }).then((result) => {
                                if (result.isConfirmed) answerEnquiries();
                                else location.reload();
                            })
                        },
                        error: function (error) {
                            Swal.fire('Error', error.responseJSON.message, 'error');
                        }
                    });
                }
            })
        }

        $( document ).ready(function() {
            $('a[href$="{{route('expert.projects.index')}}"]').parent().addClass('active');
        });

        function answerEnquiries(){
            $('#modalEnquiries').modal('show');
        }

        function submitQuestions(overwrite = false){
            let answers = [];
            @foreach($project->questions as $question)
            answers.push($('#a{{($loop->index)+1}}').val());
            @endforeach
            $.ajax({
                url: "{{ route('expert.projects.answer-enquiries')}}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    pid: "{{ $project->pid }}",
                    answers: answers,
                    overwrite: overwrite
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Thank you for answering',
                        html: response.message,
                        icon: 'success',
                        confirmButtonColor: '#5cb85c',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        location.reload();
                    })
                },
                error: function (response) {
                    let answered = response.responseJSON.answered;
                    if (answered) {
                        Swal.fire({
                            title: 'Already Answered',
                            html: response.responseJSON.message,
                            icon: 'warning',
                            confirmButtonColor: '#5cb85c',
                            confirmButtonText: 'Override Answer',
                            cancelButtonText: 'Cancel',
                            showCancelButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                submitQuestions(true);
                            }
                        })
                    } else {
                        _Swal.error(response.responseJSON.message);
                    }
                }
            });
        }

    </script>
@endpush
