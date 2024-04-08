<div class="modal fade" tabindex="-1" id="contractModals">
    <div class="modal-dialog modal-lg" style="--bs-modal-width: 800px;">
        <div class="modal-content">
            <a class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h5 class="title">Project Contract</h5>
                <div class="d-flex justify-between">
                    <p class="fs-14px">Title: <span id="contact_project_title"></span></p>
                    <div>
                        <button onclick="defaultContract()" class="btn btn-outline-info btn-sm"><i class="fa-regular fa-file-contract fs-6 me-1"></i>Default Contract</button>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label mb-0">1. Contract for Expert to Signed</label>
                    <div class="alert alert-light" id="state_1">
                        <div class="alert-notice d-flex justify-between">
                            <div class="center">
                                <span class="alert-notice-text me-1">Upload .pdf size max 3mb.</span>
                                <div class="d-flex">
                                    <div class="form-control-wrap input-uploader">
                                        <div class="form-file">
                                            <input type="file" class="form-file-input" id="customFile1">
                                            <label class="form-file-label" for="customFile"></label>
                                        </div>
                                    </div>
                                </div>
                                <span class="reupload_file clickable text-info ms-1" onclick="reupload(1)">Re-upload</span>
                            </div>
                            <a href="" class="btn-download btn btn-sm btn-primary disabled"><i class="fa-solid fa-download pe-1"></i>View</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label mb-0">2. Expert Signed Contract</label>
                    <div class="alert alert-light" id="state_2">
                        <div class="alert-notice d-flex justify-between">
                            <div class="center">
                                <span class="alert-notice-text me-1">Upload .pdf size max 3mb.</span>
                                <div class="d-flex">
                                    <div class="form-control-wrap input-uploader">
                                        <div class="form-file">
                                            <input type="file" class="form-file-input" id="customFile2">
                                            <label class="form-file-label" for="customFile"></label>
                                        </div>
                                    </div>
                                </div>
                                <span class="reupload_file clickable text-info ms-1" onclick="reupload(2)">Re-upload</span>
                            </div>
                            <a href="" class="btn-download btn btn-sm btn-primary disabled"><i class="fa-solid fa-download pe-1"></i>View</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label mb-0">3. Admin Expert Signed Agreement</label>
                    <div class="alert alert-light" id="state_3">
                        <div class="alert-notice d-flex justify-between">
                            <div class="center">
                                <span class="alert-notice-text me-1">Upload .pdf size max 3mb.</span>
                                <div class="d-flex">
                                    <div class="form-control-wrap input-uploader">
                                        <div class="form-file">
                                            <input type="file" class="form-file-input" id="customFile3">
                                            <label class="form-file-label" for="customFile"></label>
                                        </div>
                                    </div>
                                </div>
                                <span class="reupload_file clickable text-info ms-1" onclick="reupload(3)">Re-upload</span>
                            </div>
                            <a href="" class="btn-download btn btn-sm btn-primary disabled"><i class="fa-solid fa-download pe-1"></i>View</a>
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
        function setContract(project_expert_id, title = null) {
            _project_expert_id = project_expert_id;
            $('#contractModals').modal('show');
            $('.reupload_file').hide();
            $('#contact_project_title').text(title);
            // reset all state
            $('#state_1').removeClass('alert-success').addClass('alert-light');
            $('#state_1').find('.alert-notice-text').text('Upload .pdf size max 3mb.');
            $('#state_1').find('.btn-download').addClass('disabled').attr('href', '#');
            $('#state_1').find('.input-uploader').show();
            $('#state_2').removeClass('alert-success').addClass('alert-light');
            $('#state_2').find('.alert-notice-text').text('Upload .pdf size max 3mb.');
            $('#state_2').find('.btn-download').addClass('disabled').attr('href', '#');
            $('#state_2').find('.input-uploader').show();
            $('#state_3').removeClass('alert-success').addClass('alert-light');
            $('#state_3').find('.alert-notice-text').text('Upload .pdf size max 3mb.');
            $('#state_3').find('.btn-download').addClass('disabled').attr('href', '#');
            $('#state_3').find('.input-uploader').show();
            $.ajax({
                url: '{{ route('contract.check_status', ['', '', '']) }}/'+_project_expert_id,
                method: 'GET',
                success: response => {
                    console.log(response)
                    $('#modalContract').modal('hide');
                    if (response['1']) {
                        $('#state_1').removeClass('alert-light').addClass('alert-success');
                        $('#state_1').find('.alert-notice-text').text('Contract to expert has been uploaded.');
                        $('#state_1').find('.btn-download').removeClass('disabled').attr('href', '../../'+response['1'].filepath).attr('target', '_blank');
                        $('#state_1').find('.input-uploader').hide();
                        $('#state_1').find('.reupload_file').show();
                    }
                    if (response['2']) {
                        $('#state_2').removeClass('alert-light').addClass('alert-success');
                        $('#state_2').find('.alert-notice-text').text('Contract singed by expert has been uploaded.');
                        $('#state_2').find('.btn-download').removeClass('disabled').attr('href', '../../'+response['2'].filepath).attr('target', '_blank');
                        $('#state_2').find('.input-uploader').hide();
                        $('#state_2').find('.reupload_file').show();
                    }
                    if (response['3']) {
                        $('#state_3').removeClass('alert-light').addClass('alert-success');
                        $('#state_3').find('.alert-notice-text').text('Contract singed by expert and ADH admin has been uploaded.');
                        $('#state_3').find('.btn-download').removeClass('disabled').attr('href', '../../'+response['3'].filepath).attr('target', '_blank');
                        $('#state_3').find('.input-uploader').hide();
                        $('#state_3').find('.reupload_file').show();
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
                        setContract(_project_expert_id);
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        });

        $('#customFile2').on('change', function() {
            let file = $(this).prop('files')[0];
            let formData = new FormData();
            formData.append('contract', file);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                url: '{{ route('admin.contract.upload_signed', ['', '', '']) }}/'+_project_expert_id+'/expert/2',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: response => {
                    Swal.fire('Contract Uploaded', response.message, 'success').then(() => {
                        setContract(_project_expert_id);
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        });

        $('#customFile3').on('change', function() {
            let file = $(this).prop('files')[0];
            let formData = new FormData();
            formData.append('contract', file);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                url: '{{ route('admin.contract.upload_signed', ['', '', '']) }}/'+_project_expert_id+'/expert/3',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: response => {
                    Swal.fire('Contract Uploaded', response.message, 'success').then(() => {
                        setContract(_project_expert_id);
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        });


        function reupload(id) {
            $('#state_'+id).find('.input-uploader').show();
            $('#state_'+id).find('.alert-notice-text').text('');
            $('#state_'+id).find('.reupload_file').text('Cancel')
            $('#state_'+id).find('.reupload_file').attr('onclick', 'cancel('+id+')')
        }

        function cancel(id) {
            $('#state_'+id).find('.input-uploader').hide();
            $('#state_'+id).find('.alert-notice-text').text('Contract to expert has been uploaded.');
            $('#state_'+id).find('.reupload_file').text('Re-upload')
            $('#state_'+id).find('.reupload_file').attr('onclick', 'reupload('+id+')')
        }

    </script>
@endpush
