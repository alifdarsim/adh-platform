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
                    <a class="back" href="javascript:history.back()"><i
                            class="fa-solid fa-arrow-left me-1 fs-4"></i></a>
                    {{$project->name}}
                </h3>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-primary" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        <em class="icon ni ni-setting"></em>
                                        <em class="d-none d-sm-inline icon ni ni-chevron-right"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="{{route('admin.projects.edit', $project->pid)}}"><span><em
                                                            class="icon ni ni-edit me-1"></em>Edit Project</span></a>
                                            </li>
                                            <li><a class="clickable" onclick="reset('{{$project->pid}}')"><span><em
                                                            class="icon ni ni-reload me-1"></em>Reset</span></a></li>
                                            <li><a class="clickable" onclick="closeProject('{{$project->pid}}')"><span><em
                                                            class="icon ni ni-check me-1"></em>Close Project</span></a>
                                            </li>
                                            <li><a class="clickable" href="removeProject('{{$project->pid}}')"><span><em
                                                            class="icon ni ni-trash me-1"></em>Remove</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">

        @if($project->status == 'pending')
            @include('admin.projects.show.approval')
        @elseif ($project->status == 'ongoing')
            @include('admin.projects.show.expert_search')
            @include('admin.projects.show.shortlist')
            @include('admin.projects.show.ongoing')
        @elseif($project->status == 'closed')
            @include('admin.projects.show.expert_search')
            @include('admin.projects.show.shortlist')
            @include('admin.projects.show.close')
        @endif
        @include('admin.projects.show.show-detail')
    </div>

@endsection

@push('scripts')
    <script>
        function reset(pid) {
            Swal.fire({
                title: 'Reset Project?',
                text: "This will reset the project to pending status. This process is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D94148',
                cancelButtonColor: '#6E768F',
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.projects.reset', '') }}/" + pid,
                        type: 'PUT',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            Swal.fire(
                                'Reset!',
                                'Project has been reset.',
                                'success'
                            ).then((result) => {
                                window.location.reload();
                            })
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
            })
        }

        function closeProject(pid) {
            Swal.fire({
                title: 'Close Project?',
                text: "This will close the project. This process is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D94148',
                cancelButtonColor: '#6E768F',
                confirmButtonText: 'Yes, close it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.projects.close', '') }}/" + pid,
                        type: 'PUT',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            Swal.fire(
                                'Closed!',
                                'Project has been closed.',
                                'success'
                            ).then((result) => {
                                window.location.reload();
                            })
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
            })
        }

        function removeProject(pid) {
            Swal.fire({
                title: 'Remove Project?',
                text: "This will remove the project. This process is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D94148',
                cancelButtonColor: '#6E768F',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.projects.remove', '') }}/" + pid,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            Swal.fire(
                                'Removed!',
                                'Project has been removed.',
                                'success'
                            ).then((result) => {
                                window.location.href = "{{ route('admin.projects.index') }}";
                            })
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
            })
        }
    </script>
@endpush

