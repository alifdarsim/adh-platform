<div class="nk-block-head-content mt-3">
    <h6 class="title pb-1">Project Approval</h6>
</div>
<div class="card card-bordered">
    <div class="card-inner">
        <div class="tw-flex">
            <div id="status-btn" class="drodown">
                <a href="#"
                   class="dropdown-toggle btn {{$project->status == 'pending' ? 'btn-danger' : ($project->status == 'active' ? 'btn-success' : 'btn-info')}}"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <span
                        class="tw-uppercase">{{$project->status == 'pending' ? 'Pending Approval' : ($project->status == 'active' ? 'Project is Active' : $project->status)}}</span><em
                        class="dd-indc icon ni ni-chevron-down"></em>
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <ul class="link-list-opt no-bdr">
                        <li><a class="clickable" onclick="respond('shortlisted')"><em
                                    class="d-none d-sm-inline icon ni ni-check"></em><span>Approve</span></a>
                        </li>
                        <li><a class="clickable" onclick="respond('reject')"><em
                                    class="d-none d-sm-inline icon ni ni-cross"></em><span>Reject Project</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ms-5">
                <div class="me-4"><strong>Project Title:</strong> {{$project->name}}</div>
                <div class="me-4"><strong>Created By:</strong> {{$project->created_by->name}}</div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function sendRespond(status) {
            $.ajax({
                url: "{{route('admin.projects.respond', '')}}/{{$project->pid}}",
                type: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    status: status
                },
                success: function (data) {
                    Swal.fire('Success!', data.message, 'success').then(function () {
                        location.reload();
                    });
                },
                error: function (data) {
                    Swal.fire(
                        'Error!',
                        'Something went wrong.',
                        'error'
                    )
                }
            });
        }

        function respond(status) {
            let current_stat = '{{$project->status}}';
            if (status === current_stat) {
                Swal.fire('Warning!', 'Project is already ' + status, 'warning');
                return;
            }
            if (status === 'pending')
                Swal.fire({
                    title: 'Warning!',
                    text: 'This will remove project from appear in expert project list. Make sure you know what are you doing',
                    icon: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendRespond(status);
                    }
                });
            else if (status === 'reject')
                Swal.fire({
                    title: 'Reject Project?',
                    text: 'Rejecting project will mark the project as reject and no further action can be taken. Confirm?',
                    icon: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendRespond(status);
                    }
                });
            else sendRespond(status);
        }
    </script>
@endpush

