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
        buttons.each(function(){
            $(this).appendTo('.tox-menubar');
        });
    });
</script>
<div>
    <h6>Expert Contract</h6>
{{--    @if($project->contract && $project->contract->where('type', 'expert')->first() && ($project->contract->where('status', 'active')->first() || $project->contract->where('status', 'signed')->first()))--}}
{{--        @if($project->contract->where('status', 'signed')->first())--}}
    @if($project->contract && $project->contract->where('type', 'expert')->whereIn('status', ['active', 'signed'])->first())
        @if($project->contract->where('type', 'expert')->where('status', 'signed')->first())
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="alert-message">
                    <p><em class="ni ni-info me-1"></em>Signed contract has been uploaded by expert. Click below to view the contract.</p>
                    <a href="{{config('app.url')}}/contracts/{{$project->contract->where('status', 'signed')->first()->filepath}}" target="_blank" class="btn btn-primary mt-0">View Contract</a>
                </div>
            </div>
        @else
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="alert-message">
                    <p><em class="ni ni-info me-1"></em>Contract successfully upload submitted to the Expert. Waiting for expert to upload the signed contract.</p>
                </div>
            </div>
        @endif
    @else
        <div class="alert alert-warning alert-dismissible mb-1" role="alert">
            <div class="alert-message">
                <p><em class="ni ni-info me-1"></em>Project contract for expert not uploaded yet. Upload manually below or <a class="tw-text-blue-500 tw-cursor-pointer" onclick="createContract('expert')">generate one here</a></p>
            </div>
        </div>
        <div class="form-control mt-0">
            <label class="form-label" for="contract_expert">Contract for Expert</label>
            <input type="file" class="form-control" id="contract_expert" placeholder="" value="">
        </div>
    @endif
</div>

{{--@dd($project->contract->where('type', 'client')->first())--}}
<div class="mt-4">
    <h6>Client Contract</h6>
    @if($project->contract && $project->contract->where('type', 'client')->whereIn('status', ['active', 'signed'])->first())
        @if($project->contract->where('type', 'client')->where('status', 'signed')->first())
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="alert-message">
                    <p><em class="ni ni-info me-1"></em>Signed contract has been uploaded by client. Click below to view the contract.</p>
                    <a href="{{config('app.url')}}/contracts/{{$project->contract->where('type', 'client')->where('status', 'signed')->first()->filepath}}" target="_blank" class="btn btn-primary mt-0">View Contract</a>
                </div>
            </div>
        @else
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="alert-message">
                    <p><em class="ni ni-info me-1"></em>Contract successfully upload submitted to the Client. Waiting for client to upload the signed contract.</p>
                </div>
            </div>
        @endif
    @else
        <div class="alert alert-warning alert-dismissible" role="alert">
            <div class="alert-message">
                <p><em class="ni ni-info me-1"></em>Project contract for client not created yet. <a class="tw-text-blue-500 tw-cursor-pointer" onclick="createContract('client')">Generate one here</a></p>
            </div>
        </div>
        <div class="form-control mt-0">
            <label class="form-label" for="contract_client">Contract for Client</label>
            <input type="file" class="form-control" id="contract_client" placeholder="" value="">
        </div>
    @endif

</div>

<div class="modal fade" tabindex="-1" id="modalContract">
    <div class="modal-dialog modal-xl" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Contract</h5>
                <button type="button" class="btn btn-primary" onclick="saveContract()">Load Default</button>
            </div>
            <div class="modal-body p-1">
                <div class="card-inner p-0">
                    <div class="tw-h-screen">
                        <textarea id="mytextarea" class="h-100">
{{--                            {{$project->contract->content ?? ''}}--}}
                        </textarea>
                    </div>
                </div>
            </div>
{{--            <div class="modal-footer">--}}
{{--                <button type="button" class="btn btn-primary" onclick="saveContract()">Save as Draft</button>--}}
{{--                <button type="button" class="btn btn-success" onclick="submitContract()">Submit Contract</button>--}}
{{--            </div>--}}
        </div>
    </div>
</div>

{{--@if($project->contract && $project->contract->status == "submit")--}}
{{--    <div class="alert alert-success alert-dismissible" role="alert">--}}
{{--        <div class="alert-message">--}}
{{--            <p><em class="ni ni-info me-1"></em>Contract has been submitted to the Expert</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@else--}}
{{--    <div class="alert alert-secondary alert-dismissible" role="alert">--}}
{{--        <div class="alert-message">--}}
{{--            <p><em class="ni ni-info me-1"></em>No contract to the expert yet</p>--}}
{{--        </div>--}}
{{--    </div>--}}




{{--@endif--}}


@push('scripts')
    <script>
        $(document).ready(function(){
            let container = $('.tw-h-screen').height() - 370;
            $('.tw-h-screen').css('height', container);
        });


        let default_contract = {!! json_encode(\App\Models\Contract::select('content')->first()->content ?? '') !!};
        function loadContract(){
            _Swal.loadingCallback('Load Contract...', 'Please wait while we load the default contract', 1000, function(){
                tinymce.activeEditor.setContent(default_contract);
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

        function createContract(){
            $('#modalContract').modal('show');
        }

        $('#contract_expert').on('change', function(){
            let file = $(this).prop('files')[0];
            let formData = new FormData();
            formData.append('contract', file);
            formData.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: '{{route('contract.upload_signed', ['', '', ''])}}/{{$project->pid}}/expert/active',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: response => {
                    Swal.fire('Contract Uploaded', response.message, 'success').then( () => {
                        window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=contract" );
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        });

        $('#contract_client').on('change', function(){
            let file = $(this).prop('files')[0];
            let formData = new FormData();
            formData.append('contract', file);
            formData.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: '{{route('contract.upload_signed', ['', '', ''])}}/{{$project->pid}}/client/active',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: response => {
                    Swal.fire('Contract Uploaded', response.message, 'success').then( () => {
                        window.location.href = window.location.href.replace( /[\?#].*|$/, "?tab=contract" );
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        });
    </script>
@endpush
