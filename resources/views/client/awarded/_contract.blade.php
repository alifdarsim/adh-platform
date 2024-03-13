<div>
    <h6>View Contract and Upload Signed Contract</h6>
    @if($project->contract && $project->contract->where('type', 'client')->where('status', 'active')->first())
        <div class="alert alert-light alert-dismissible" role="alert">
            <div class="alert-message">
                <p><em class="ni ni-info me-1"></em>Project contract has been uploaded. Click below to download the contract.</p>
                <a href="{{config('app.url')}}/contracts/{{$project->contract->where('type', 'client')->first()->filepath}}" target="_blank" class="btn btn-primary mt-0">Download Contract</a>
            </div>
        </div>
        <h6 class="mt-4">Upload Signed Contract</h6>
        @if($project->contract && $project->contract->where('type', 'client')->where('status', 'signed')->first())
            <div class="alert alert-light alert-dismissible" role="alert">
                <div class="alert-message">
                    <p><em class="ni ni-check me-1"></em>Your signed contract for this project has been uploaded</p>
                </div>
            </div>
        @else
            <input type="file" class="form-control" id="upload_contract" placeholder="" value="">
        @endif
    @else
        <div class="alert alert-secondary alert-dismissible" role="alert">
            <div class="alert-message">
                <p><em class="ni ni-info me-1"></em>Admin not upload contract for this project yet</p>
            </div>
        </div>
    @endif
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
