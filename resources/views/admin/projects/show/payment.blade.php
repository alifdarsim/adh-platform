<div class="nk-block-head-content mt-3">
    <h6 class="title pb-1">Pending Action by Admin</h6>
</div>
<div class="example-alert">
    <div class="alert alert-fill bg-info-dim alert-icon border !tw-border-blue-500">
        <em class="icon ni ni-money"></em>
        <p class="mb-1">Kindly go to the payment section and release the payment to the expert for this project.</p>
        <a onclick="closeProject()" class="btn btn-primary px-3"><em class="ni ni-check-circle-fill me-1 fs-6"></em>Close Project</a>
    </div>
</div>
@push('scripts')
    <script>
        function closeProject(){
            Swal.fire({
                title: 'Mark as Completed?',
                text: "Project will be completed and proceed to expert payment.",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.close', $project->pid)}}',
                        type: 'PUT',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            Swal.fire(
                                'Closed!',
                                'The project has been completed. Please proceed with paying the expert.',
                                'success'
                            ).then((result) => {
                                location.reload()
                            })
                        },
                        error: function (data) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            )
                        }
                    })
                }
            })
        }
    </script>
@endpush

