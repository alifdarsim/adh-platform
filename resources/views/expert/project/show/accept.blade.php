<div class="nk-block-head-content mt-3">
    <h6 class="title pb-1">Project Acceptation</h6>
</div>
<div class="card card-bordered">
    <div class="card-inner">
        <div class="tw-flex">
            <div id="status-btn" class="drodown">
                <a href="#"
                   class="dropdown-toggle btn btn-info"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span
                        class="tw-uppercase">Accept or Reject Project</span><em
                        class="dd-indc icon ni ni-chevron-down"></em>
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <ul class="link-list-opt no-bdr">
                        <li><a class="clickable" onclick="respond('{{$project_expert->id}}','accept')"><em
                                    class="d-none d-sm-inline icon ni ni-check"></em><span>Accept Project</span></a>
                        </li>
                        <li><a class="clickable" onclick="respond('{{$project_expert->id}}','reject')"><em
                                    class="d-none d-sm-inline icon ni ni-cross"></em><span>Reject Project</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ms-5">
                <div class="me-4"><strong>Project Title:</strong> {{$project->name}}</div>
                <div class="me-4"><strong>Choose whether to accept or reject the project</strong></div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>

        function respond(project_expert_id, accept) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You want to ${accept ? 'show interest' : 'reject'} on this project?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: 'No, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('expert.projects.respond') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            project_expert_id: project_expert_id,
                            respond: accept
                        },
                        success: function(response) {
                            Swal.fire('Success', response.message, 'success').then(function() {
                                location.reload();
                            });
                        },
                        error: function(error) {
                            Swal.fire('Error', error.responseJSON.message, 'error');
                        }
                    });
                }
            });
        }
    </script>
@endpush

