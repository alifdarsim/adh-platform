<h6>Expert Contract</h6>

@if($project->contract && $project->contract->status == "submit")
    <div class="alert alert-success alert-dismissible" role="alert">
        <div class="alert-message">
            <p><em class="ni ni-info me-1"></em>Contract has been submitted to the Expert</p>
        </div>
    </div>
@else
    <div class="alert alert-secondary alert-dismissible" role="alert">
        <div class="alert-message">
            <p><em class="ni ni-info me-1"></em>No contract to the expert yet</p>
        </div>
    </div>

    <script src="/libs/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#mytextarea",
            menu: {
                file: { title: 'File', items: 'newdocument restoredraft | preview | export print | deleteallconversations' },
                edit: { title: 'Edit', items: 'undo redo | cut copy paste pastetext | selectall | searchreplace' },
                view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen | showcomments' },
                insert: { title: 'Insert', items: 'image link media addcomment pageembed template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor tableofcontents | insertdatetime' },
                format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | styles blocks fontfamily fontsize align lineheight | forecolor backcolor | language | removeformat' },
                help: { title: 'Help', items: 'help' }
            },
            plugins: 'export',
            promotion: false,
            toolbar: 'customInsertButton customDraftButton customSubmitButton',
            menubar: 'file format',
            height : "100%",
            setup: function (editor) {
                editor.ui.registry.addButton('customInsertButton', {
                    text: 'Load Default',
                    onAction: function () {
                        loadContract();
                    }
                });
                editor.ui.registry.addButton('customDraftButton', {
                    text: 'Save as Draft',
                    onAction: function () {
                        saveContract();
                    }
                });
                editor.ui.registry.addButton('customSubmitButton', {
                    text: 'Submit Contract',
                    onAction: function () {
                        submitContract();
                    }
                });

            }
        }).then( () => {
            let buttons = $('.tox-toolbar-overlord').find('.tox-tbtn--select');
            console.log(buttons)
            buttons.each(function(){
                $(this).appendTo('.tox-menubar');
            });
        });
    </script>

    <div class="tw-h-screen">
        <textarea id="mytextarea" class="h-100">{{$project->contract->content ?? ''}}</textarea>
    </div>

@endif


@push('scripts')
    <script>
        $(document).ready(function(){
            let container = $('.tw-h-screen').height() - 370;
            $('.tw-h-screen').css('height', container);
        });


        let default_contract = {!! json_encode(\App\Models\Contract::select('content')->first()->content ?? '') !!};
        function loadContract(){
            Swal.fire({
                title: 'Load Default Contract',
                text: 'This will overwrite the content with default contract. Continue?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then( (result) => {
                if(result.isConfirmed){
                    _Swal.loadingCallback('Load Contract...', 'Please wait while we load the default contract', 1000, function(){
                        tinymce.activeEditor.setContent(default_contract);
                    });
                }
            });
        }

        function saveContract(){
            let contract = tinymce.activeEditor.getContent();
            $.ajax({
                url: '{{route('admin.contract.update', '')}}/{{$project->pid}}',
                method: 'PUT',
                data: {
                    contract: contract,
                    status: 'draft'
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                datatype: 'json',
                success: response => {
                    Swal.fire('Contract Saved', response.message, 'success').then( () => {
                        window.location.href = '{{route('admin.projects.show', ['pid' => $project->pid])}}';
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        }

        function submitContract(){
            let contract = tinymce.activeEditor.getContent();
            $.ajax({
                url: '{{route('admin.contract.update', '')}}/{{$project->pid}}',
                method: 'PUT',
                data: {
                    contract: contract,
                    status: 'submit'
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                datatype: 'json',
                success: response => {
                    Swal.fire('Contract Submitted', response.message, 'success').then( () => {
                        window.location.href = '{{route('admin.projects.show', ['pid' => $project->pid])}}';
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        }
    </script>
@endpush
