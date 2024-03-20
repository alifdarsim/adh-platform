<div class="tw-col-span-3">
    <div class="tw-flex tw-justify-between">
        <p class="sub-text" style="text-transform: uppercase;"><i class="fa-solid fa-clock fs-11px me-1"></i> POSTED: {{ formatDate($project->published_at) }}</p>
    </div>
    <h6 class="my-3">
        <div id="status-btn" class="drodown">
            <h6 class="fs-14px">Project Status</h6>
            @if($project->status == 'closed')
                <a class="tw-cursor-default dropdown-toggle btn btn-dark"><span
                        class="tw-uppercase">CLOSED</span></a>
            @else
                <a href="#" class="dropdown-toggle btn {{$project->status == 'awarded' ? 'btn-success' : ($project->status == 'active' ? 'btn-success' : 'btn-info')}}" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="tw-uppercase">
                                {{$project->status == 'awarded' ? 'Project Awarded' : ($project->status == 'active' ? 'Project is Active' : $project->status)}}
                            </span>
                    <em class="dd-indc icon ni ni-chevron-down"></em>
                </a>
                <div class="dropdown-menu dropdown-menu-end" style="">
                    <ul class="link-list-opt no-bdr">
                        <li><a class="clickable" onclick="closedProject()"><em class="d-none d-sm-inline icon ni ni-check"></em><span>Closed Project</span></a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </h6>
    <div class="d-flex mt-2">
        <h4 class="my-0">Project: {{$project->name}}</h4>
    </div>
    <div class="tw-container tw-mx-auto">
        <div class="my-2">
            <p class="tw-text-slate-600 fs-13px">{!! nl2br(e($project->description)) !!}</p>
        </div>
    </div>
{{--    <p class="mb-0 mt-2">Budget: {{$project->budget == null ? 'Undisclosed' : '$' . implode(' - ', $project->budget) . ' USD'}} </p>--}}
    <p class="mb-0 mt-1">Hub Types: <span class="">{{$project->hub->name}}</span></p>
    <p class="mb-0 mt-1">Created By: <a  class="tw-text-blue-500 hover:tw-text-blue-800">{{$project->createdBy->name ?? ''}}</a></p>
    <p class="mb-0 mt-1">Awarded To: <a  class="tw-text-blue-500 hover:tw-text-blue-800">{{$project->awardedTo->name ?? ''}}</a></p>
    <div class="tw-flex tw-justify-between mt-1">
        <p class="mb-0">Tags: @foreach($project->keywords as $keyword)
                <span class="badge bg-outline-info border-2 tw-rounded-full tw-capitalize fs-12px tw-font-medium px-2 tw-py-0.5">{{$keyword->name}}</span>
            @endforeach</p>
    </div>
    <div class="tw-flex tw-justify-between mt-3">
        <p class="mb-0">Projects ID: #{{$project->pid}}</p>
        <p onclick="reportProject()" class="fs-12px tw-cursor-pointer hover:tw-text-red-700"><i class="fa-solid fa-flag me-1"></i> Report Projects</p>
    </div>
</div>
<script>
    function closedProject(){
        Swal.fire({
            title: 'Mark project as Close?',
            text: "Confirm to close this project? This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, close it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{route('admin.projects.close', $project->pid)}}",
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        _Swal.success(response.message, 'Project Closed', function () {
                            location.reload();
                        })
                    },
                    error: function (response) {
                        _Swal.error(response.responseJSON.message, 'Error');
                    }
                });
            }
        });
    }

</script>
