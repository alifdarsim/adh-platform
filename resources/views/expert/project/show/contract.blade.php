<div>
    <h6>Project Status</h6>
    <div class="card">
        <div class="card-inner">
            @if($project->contract && $project->contract->where('type', 'expert')->where('status', 'active')->first())
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="alert-message">
                        <p class="mb-1"><em class="ni ni-info me-1"></em>Project contract has been uploaded by Admin. Click below to download the contract.</p>
                        <a href="{{config('app.url')}}/contracts/{{$project->contract->where('type', 'expert')->first()->filepath}}" target="_blank" class="btn btn-sm btn-primary mt-0">Download Contract</a>
                    </div>
                </div>
                <h6 class="mt-4">Upload Signed Contract</h6>
                @if($project->contract && $project->contract->where('type', 'expert')->where('status', 'signed')->first())
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="alert-message">
                            <p><em class="ni ni-check me-1"></em>Your signed contract has been uploaded. Admin will notify you through email once your contract has been verify.</p>
                        </div>
                    </div>
                @else
                    <input type="file" class="form-control" id="upload_contract" placeholder="" value="">
                @endif
            @else
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="alert-message">
                        <p><em class="ni ni-info me-1"></em>Project is ongoing. Please contact admin when you finish the project.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script>
        {{--$('#upload_contract').on('change', function(){--}}
        {{--    let file = $(this).prop('files')[0];--}}
        {{--    let formData = new FormData();--}}
        {{--    formData.append('contract', file);--}}
        {{--    formData.append('_token', '{{csrf_token()}}');--}}
        {{--    $.ajax({--}}
        {{--        url: '{{route('contract.upload_signed', ['','',''])}}/{{$project->pid}}/expert/signed',--}}
        {{--        method: 'POST',--}}
        {{--        data: formData,--}}
        {{--        contentType: false,--}}
        {{--        processData: false,--}}
        {{--        success: response => {--}}
        {{--            Swal.fire('Contract Uploaded', response.message, 'success').then( () => {--}}
        {{--                window.location.href = '{{route('expert.projects.show', ['pid' => $project->pid])}}';--}}
        {{--            });--}}
        {{--        },--}}
        {{--        error: response => {--}}
        {{--            Swal.fire('Error', response.responseJSON.message, 'error')--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endpush
