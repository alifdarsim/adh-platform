@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a class="back" href="{{route('client.projects.index')}}"><i
                                class="fa-solid fa-arrow-left me-2 fs-4"></i></a>{{$project->name}}</h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        @include('status.index')

        @if($project->payment && $project->payment->where('received_status', 'pending')->first())
            <div class="nk-block-head-content mt-3">
                <h6 class="title pb-1">Pending Action by You</h6>
            </div>
            <div class="example-alert mb-3">
                <div class="alert alert-fill bg-warning-dim alert-icon border !tw-border-yellow-500">
                    <em class="icon ni ni-money"></em>
                    <p class="mb-1">You have pending Payment agreed upon this project of amount <strong>{{$project->payment->where('received_status', 'pending')->first()->received_amount}}</strong>. Please proceed with the payment to AsiaDealHub.</p>
                    <a href="{{route('client.payment.index')}}" class="btn btn-primary">Pay Pending Payment</a>
                </div>
            </div>
        @elseif($project->payment && $project->payment->where('received_status', 'confirmed')->first())
            <div class="nk-block-head-content mt-3">
                <h6 class="title pb-1">Project Status</h6>
            </div>
            <div class="example-alert mb-3">
                <div class="alert alert-fill bg-success-dim alert-icon border !tw-border-green-500">
                    <em class="icon ni ni-money"></em>
                    <p class="mb-1">Project for this payment has been received and verify by AsiaDealHub admin. If the project is completed, you can ignore this message for the admin to close the project.</p>
                </div>
            </div>
        @endif

        @if($project->status == 'pending')
            @include('client.project.show.approve')
        @elseif ($project->status == 'shortlisted')
            @include('client.project.show.shortlist')
        @elseif ($project->status == 'awarded')
            @include('client.project.show.award')
        @elseif ($project->status == 'contract')
            @include('client.project.show.contract')
        @elseif ($project->status == 'started')
            @include('client.project.show.start')
        @endif

        @include('admin.projects.show.show-detail')
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
