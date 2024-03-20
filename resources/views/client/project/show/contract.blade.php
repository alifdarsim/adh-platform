<div class="nk-block-head-content mt-3">
    <h6 class="title pb-1">Contract Set Up</h6>
</div>
<div class="card">
    <div class="card-inner">
        <h6 class="fs-14px">View Contract and Upload Signed Contract</h6>
        @if($project->contract && $project->contract->where('type', 'client')->where('status', 'active')->first())
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="alert-message">
                    <p class="mb-1"><em class="ni ni-info me-1"></em>Project contract has been uploaded by Admin. Click below to download the contract.</p>
                    <a href="{{config('app.url')}}/contracts/{{$project->contract->where('type', 'client')->first()->filepath}}" target="_blank" class="btn btn-primary mt-0">Download Contract</a>
                </div>
            </div>
            <h6 class="fs-14px mt-4">Upload Signed Contract</h6>
            @if($project->contract && $project->contract->where('type', 'client')->where('status', 'signed')->first())
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="alert-message">
                        <p><em class="ni ni-check me-1"></em>Your signed contract has been uploaded. Admin will notify you through email once your contract has been verify.</p>
                    </div>
                </div>
            @else
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <div class="alert-message">
                        <p class="mb-1"><em class="ni ni-info me-1"></em>Upload the contract that has been signed here.</p>
                        <input type="file" class="form-control" id="upload_contract" placeholder="" value="">
                    </div>
                </div>

            @endif
        @else
            <div class="alert alert-secondary alert-dismissible" role="alert">
                <div class="alert-message">
                    <p><em class="ni ni-info me-1"></em>Admin not upload contract for this project yet</p>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        $('#upload_contract').on('change', function(){
            let file = $(this).prop('files')[0];
            let formData = new FormData();
            formData.append('contract', file);
            formData.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: '{{route('contract.upload_signed', ['','',''])}}/{{$project->pid}}/client/signed',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: response => {
                    Swal.fire('Contract Uploaded', response.message, 'success').then( () => {
                        window.location.href = '{{route('client.projects.show', ['pid' => $project->pid])}}';
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        });
    </script>
@endpush
