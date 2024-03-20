<div class="nk-block-head-content mt-3">
    <h6 class="title pb-1">Project Status: Project Started</h6>
</div>
<div class="example-alert">
    <div class="alert alert-fill bg-info-dim alert-icon border !tw-border-blue-500">
        <em class="icon ni ni-check-circle"></em>
        <p class="mb-0">Project has been verified and the expert has been ask to start the project.</p>
        <p class="mb-2">Make sure to keep in touch with the expert and client to ensure the project is running smoothly.</p>
        <div class="border border-info-subtle"></div>
        <p class="mb-1 mt-2">Once the project is completed, you can close the project. Client will check the project and close the project.</p>
        <a onclick="closeProject()" class="btn btn-primary px-3"><em class="ni ni-check-circle-fill me-1 fs-6"></em>Project Complete & Pay Expert</a>
    </div>
</div>

@push('scripts')
    <script>
        function closeProject(){
            // if payment not received yet, show error
            if ('{{$project->payment->where('received_status', 'pending')->count()}}' > 0) {
                Swal.fire(
                    'Client Yet to Make any Payment!',
                    'Please make sure ADH received the payment from the client before closing the project.',
                    'warning'
                )
                return;
            }
            Swal.fire({
                title: 'Mark as Completed?',
                text: "Project will be completed and proceed to expert payment.",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.payment', $project->pid)}}',
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

