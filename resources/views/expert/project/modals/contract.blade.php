<div class="modal fade" tabindex="-1" id="contractModals">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h4 class="title">Contract</h4>
                <div class="form-group">
                    <label class="form-label mb-0">1. Contract for Expert to Signed</label>
                    <div class="alert alert-light" id="state_1">
                        <div class="alert-notice row">
                            <div class="col-9">
                                <span class="alert-notice-icon"><em class="icon ni ni-alert-circle"></em></span>
                                <span class="alert-notice-text">Upload .pdf size max 3mb.</span>
                                <div class="form-control-wrap">
                                    <div class="form-file">
                                        <input type="file" class="form-file-input" id="customFile1">
                                        <label class="form-file-label" for="customFile"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div>.</div>
                                <a href="" class="btn-download btn btn-sm btn-primary disabled"><i class="fa-solid fa-download pe-1"></i>Download</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label mb-0">2. Expert Signed Contract</label>
                    <div class="alert alert-warning">
                        <div class="alert-notice">
                            <span class="alert-notice-text">Waiting for expert to uploads signed contract.</span>
{{--                            <span class="alert-notice-text">Upload .pdf size max 3mb.</span>--}}
{{--                            <div class="form-control-wrap">--}}
{{--                                <div class="form-file">--}}
{{--                                    <input type="file" class="form-file-input" id="customFile">--}}
{{--                                    <label class="form-file-label" for="customFile"></label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label mb-0">3. Admin Expert Signed Agreement</label>
                    <div class="alert alert-warning">
                        <div class="alert-notice">
                            <span class="alert-notice-text">Waiting for expert to uploads signed contract.</span>
                            {{--                            <span class="alert-notice-text">Upload .pdf size max 3mb.</span>--}}
                            {{--                            <div class="form-control-wrap">--}}
                            {{--                                <div class="form-file">--}}
                            {{--                                    <input type="file" class="form-file-input" id="customFile">--}}
                            {{--                                    <label class="form-file-label" for="customFile"></label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let _project_expert_id = null;
        function setContract(project_expert_id) {
            _project_expert_id = project_expert_id;
            $('#contractModals').modal('show');

            $.ajax({
                url: '{{ route('contract.check_status', ['', '', '']) }}/'+_project_expert_id,
                method: 'GET',
                success: response => {
                    console.log(response)
                    console.log(response['1'])
                    if (response['1']) {
                        $('#state_1').removeClass('alert-light').addClass('alert-success');
                        $('#state_1').find('.alert-notice-text').text('Contract to expert has been uploaded.');
                        // set name file inside input
                        $('#state_1').find('.btn-download').removeClass('disabled').attr('href', response['1'].filepath);
                    }
                }
            });

        }

        $('#customFile1').on('change', function() {
            let file = $(this).prop('files')[0];
            let formData = new FormData();
            formData.append('contract', file);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                url: '{{ route('admin.contract.upload_signed', ['', '', '']) }}/'+_project_expert_id+'/expert/1',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: response => {
                    Swal.fire('Contract Uploaded', response.message, 'success').then(() => {
                        location.reload();
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        });


    </script>
@endpush
