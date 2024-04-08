<script src="/libs/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "#mytextarea",
        menu: {
            file: {
                title: 'File',
                items: 'newdocument restoredraft | preview | export print | deleteallconversations'
            },
            edit: {
                title: 'Edit',
                items: 'undo redo | cut copy paste pastetext | selectall | searchreplace'
            },
            view: {
                title: 'View',
                items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments'
            },
            insert: {
                title: 'Insert',
                items: 'image link media addcomment pageembed template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime'
            },
            format: {
                title: 'Format',
                items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat'
            },
            help: {
                title: 'Help',
                items: 'help'
            }
        },
        plugins: 'export',
        promotion: false,
        toolbar: 'customInsertButton customPdfButton customSubmitButton',
        menubar: 'file format',
        height: "100%",
        setup: function(editor) {
            editor.ui.registry.addButton('customInsertButton', {
                text: 'Load Default',
                onAction: function() {
                    loadContract();
                }
            });
            editor.ui.registry.addButton('customPdfButton', {
                text: 'Download',
                onAction: function() {
                    downloadContract();
                }
            });
            editor.ui.registry.addButton('customSubmitButton', {
                text: 'Submit Contract',
                onAction: function() {
                    submitContract();
                }
            });

        }
    }).then(() => {
        let buttons = $('.tox-toolbar-overlord').find('.tox-tbtn--select');
        buttons.each(function() {
            $(this).appendTo('.tox-menubar');
        });
    });
</script>

<div class="modal fade" tabindex="-1" id="modalContract">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contract_title">Contract</h5>
            </div>
            <div class="modal-body p-1">
                <div class="card-inner p-0">
                    <div class="tw-h-[600px]">
                        <textarea id="mytextarea" class="h-100">
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function defaultContract() {
            $('.tox-toolbar--scrolling').appendTo('.tox-menubar');
            $('#modalContract').modal('show');
        }

        function loadContract() {
            _Swal.loadingCallback('', 'Please wait while we load the default contract', 300, function() {
                $.ajax({
                    url: '{{ route('admin.contract.default', '') }}/expert',
                    method: 'GET',
                    success: response => {
                        tinymce.activeEditor.setContent(response);
                    },
                    error: response => {
                        Swal.fire('Error', response.responseJSON.message, 'error')
                    }
                });
            });
        }

        function downloadContract(){
            tinymce.activeEditor.plugins.export.download('clientpdf', {});
        }

        function submitContract() {
            Swal.fire({
                title: 'Submit Contract',
                text: 'Are you sure you want to set this contract for this expert?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return new Promise((resolve) => {
                        setTimeout(() => {
                            resolve();
                        }, 1000);
                    });
                }
            }).then((result) => {
                // if swal is confirmed
                if (result.isConfirmed) {
                    if (!tinymce.activeEditor.getContent()) {
                        Swal.fire('Error', 'Contract cannot be empty', 'error');
                        return;
                    }

                    tinymce.activeEditor.plugins.export.convert('clientpdf', {}).then(function(pdf) {
                        let formData = new FormData();
                        formData.append('contract', pdf);
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
                }


            });
        }
    </script>
@endpush
