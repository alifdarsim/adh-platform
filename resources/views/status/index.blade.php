<div class="nk-block-head-content">
    <h6 class="title pb-1">Project Status
    </h6>
</div>
<div class="d-block mb-2">
    <div class="card card-bordered">
        <div class="card-inner">
            <div class="d-flex project-status">
                <div id="status_approve" class="btn btn-sm btn-outline-info tw-w-32 center disabled">Approve</div>
                <div class="tw-w-6 d-flex center"><i class="fa-light fa-arrow-right text-dark"></i></div>
                <div id="status_shortlisted" class="btn btn-sm btn-outline-info tw-w-44 center disabled">Expert Searching</div>
                <div class="tw-w-6 d-flex center"><i class="fa-light fa-arrow-right text-dark"></i></div>
                <div id="status_awarded" class="btn btn-sm btn-outline-info tw-w-36 center disabled">Award Project</div>
                <div class="tw-w-6 d-flex center"><i class="fa-light fa-arrow-right text-dark"></i></div>
                <div id="status_contract" class="btn btn-sm btn-outline-info tw-w-40 center disabled">Contract & Payment</div>
                <div class="tw-w-6 d-flex center"><i class="fa-light fa-arrow-right text-dark"></i></div>
                <div id="status_start" class="btn btn-sm btn-outline-info tw-w-36 center disabled">Project Start</div>
                <div class="tw-w-6 d-flex center"><i class="fa-light fa-arrow-right text-dark"></i></div>
                <div id="status_payment" class="btn btn-sm btn-outline-info tw-w-36 center disabled">Expert Payment</div>
                <div class="tw-w-6 d-flex center"><i class="fa-light fa-arrow-right text-dark"></i></div>
                <div id="status_close" class="btn btn-sm btn-outline-info tw-w-32 center disabled">Complete</div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        let project_status = '{{$project->status}}';
        console.log(project_status)
        if (project_status === 'pending'){
            $('#status_approve').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-caret-right tw-me-1"></i>Approve');
        } else if (project_status === 'active'){
            $('#status_approve').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Approve');
        } else if (project_status === 'shortlisted'){
            $('#status_approve').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Approve');
            $('#status_shortlisted').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-caret-right tw-me-1"></i>Expert Searching');
        } else if (project_status === 'awarded'){
            $('#status_approve').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Approve');
            $('#status_shortlisted').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Expert Searching');
            $('#status_awarded').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-caret-right tw-me-1"></i>Award Project');
        } else if (project_status === 'contract'){
            $('#status_approve').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Approve');
            $('#status_shortlisted').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Expert Searching');
            $('#status_awarded').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Award Project');
            $('#status_contract').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-caret-right tw-me-1"></i>Contract & Payment');
        }
        else if (project_status === 'started'){
            $('#status_approve').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Approve');
            $('#status_shortlisted').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Expert Searching');
            $('#status_awarded').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Award Project');
            $('#status_contract').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Contract & Payment');
            $('#status_start').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-caret-right tw-me-1"></i>Project Start');
        }
        else if (project_status === 'payment'){
            $('#status_approve').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Approve');
            $('#status_shortlisted').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Expert Searching');
            $('#status_awarded').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Award Project');
            $('#status_contract').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Contract & Payment');
            $('#status_start').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Project Start');
            $('#status_payment').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Expert Payment');
        }
        else if (project_status === 'closed'){
            $('#status_approve').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Approve');
            $('#status_shortlisted').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Expert Searching');
            $('#status_awarded').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Award Project');
            $('#status_contract').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Contract & Payment');
            $('#status_start').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Project Start');
            $('#status_payment').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-check tw-me-1"></i>Expert Payment');
            $('#status_close').removeClass('disabled btn-outline-info').addClass('btn-info').html('<i class="fa-solid fa-caret-right tw-me-1"></i>Close');
        }
    </script>
@endpush

