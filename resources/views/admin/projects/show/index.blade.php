@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a class="back" href="{{route('admin.projects.index')}}"><i
                                class="fa-solid fa-arrow-left me-2 fs-4"></i></a>{{$project->name}}</h3>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="{{route('admin.companies.create')}}" class="btn btn-primary toggle-expand" data-target="pageMenu"><span>Add Company</span></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a id="award_btn" onclick="openAwardModal()" class="btn btn-white btn-primary {{$project->status == 'pending' ? 'disabled' : ''}}"><i class="fa-solid fa-award fs-6 tw-ms-0.5 me-3"></i><span>Award Project to an Expert</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <div class="tw-flex tw-justify-between">
                    <div>
                        <div class="me-4"><strong>Project Name:</strong> {{$project->name}}</div>
                        <div class="me-4"><strong>Project ID:</strong> {{request()->segment(3)}}</div>
                        <div class="me-4"><strong>Created By:</strong> {{$project->created_by->name}}</div>
                    </div>
                    <div id="status-btn" class="drodown">
                        <h6 class="fs-14px">Project Status</h6>
                        @if($project->status == 'awarded')
                            <a class="tw-cursor-default dropdown-toggle btn btn-info"><span
                                        class="tw-uppercase">AWARDED</span></a>
                        @elseif($project->status == 'active')
                            <a class="tw-cursor-default dropdown-toggle btn btn-info"><span class="tw-success">SHORTLISTING</span></a>
                        @elseif($project->status == 'reject')
                            <a class="tw-cursor-default dropdown-toggle btn btn-danger"><span class="tw-success">REJECTED</span></a>
                        @else
                            <a href="#"
                               class="dropdown-toggle btn {{$project->status == 'pending' ? 'btn-danger' : ($project->status == 'active' ? 'btn-success' : 'btn-info')}}"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <span
                                        class="tw-uppercase">{{$project->status == 'pending' ? 'Pending Approval' : ($project->status == 'active' ? 'Project is Active' : $project->status)}}</span><em
                                        class="dd-indc icon ni ni-chevron-down"></em>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="">
                                <ul class="link-list-opt no-bdr">
                                    <li><a class="clickable" onclick="respond('active')"><em
                                                    class="d-none d-sm-inline icon ni ni-check"></em><span>Approve</span></a>
                                    </li>
                                    <li><a class="clickable" onclick="respond('reject')"><em
                                                    class="d-none d-sm-inline icon ni ni-cross"></em><span>Reject Project</span></a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('admin.projects.show.show-shortlist')
        @include('admin.projects.show.show-detail')
    </div>

    @include('admin.projects.show.show-expert-list')
    @include('admin.projects.show.show-award')
    @include('admin.projects.show.modal-expert-detail')

@endsection
@push('scripts')
    <script src="/assets/js/libs/tagify.js?ver=3.2.2"></script>
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="/assets/js/apps/file-manager.js?ver=3.2.2"></script>
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
                        if (status === 'active') {
                            $('#status-btn').html(`<h6 class="fs-14px">Project Status</h6><a class="tw-cursor-default dropdown-toggle btn btn-info"><span class="tw-uppercase">SHORTLISTING</span></a>`);
                            $('#add_expert_btn').removeClass('disabled');
                            $('#award_btn').removeClass('disabled');
                            return;
                        }
                        $('#status-btn').html(`<h6 class="fs-14px">Project Status</h6><a class="tw-cursor-default dropdown-toggle btn btn-danger"><span class="tw-uppercase">REJECTED</span></a>`);
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
