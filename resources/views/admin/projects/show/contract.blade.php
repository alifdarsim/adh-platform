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
        toolbar: 'customInsertButton customSubmitButton',
        menubar: 'file format',
        height : "100%",
        setup: function (editor) {
            editor.ui.registry.addButton('customInsertButton', {
                text: 'Reload Default Contract',
                onAction: function () {
                    loadContract();
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

<h6 class="mt-3">Set a Contract for Client and Expert</h6>
<div class="card card-bordered">
    <div class="card-inner row">
        <div class="col-6">
            <div>
                <h6>Upload Client Contract</h6>
                @if($project->contract && $project->contract->where('type', 'client')->whereIn('status', ['active', 'signed'])->first())
                    @if($project->contract->where('type', 'client')->where('status', 'signed')->first())
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <div class="alert-message">
                                <p class="mb-1"><em class="ni ni-info me-1"></em>Signed contract has been uploaded by client. Click below to view the contract.</p>
                                <a href="{{config('app.url')}}/contracts/{{$project->contract->where('type', 'client')->where('status', 'signed')->first()->filepath}}" target="_blank" class="btn btn-primary mt-0">View Contract</a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <div class="alert-message">
                                <p><em class="ni ni-info me-1"></em>Contract successfully upload submitted to the Client. Please wait for client to upload the signed contract for this project.</p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="alert alert-warning alert-dismissible mb-1" role="alert">
                        <div class="alert-message">
                            <p><em class="ni ni-info me-1"></em>Project contract for client not created yet. <a class="tw-text-blue-500 tw-cursor-pointer" onclick="createContract('client')">Edit from default here</a></p>
                        </div>
                    </div>
                    <div class="form-control mt-0">
                        <label class="form-label" for="contract_client">Contract for Client</label>
                        <input type="file" class="form-control" id="contract_client" placeholder="" value="">
                    </div>
                @endif
            </div>
            <div class="mt-4">
                <h6>Upload Expert Contract</h6>
                @if($project->contract && $project->contract->where('type', 'expert')->whereIn('status', ['active', 'signed'])->first())
                    @if($project->contract->where('type', 'expert')->where('status', 'signed')->first())
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <div class="alert-message">
                                <p class="mb-1"><em class="ni ni-info me-1"></em>Signed contract has been uploaded by expert. Click below to view the contract.</p>
                                <a href="{{config('app.url')}}/contracts/{{$project->contract->where('status', 'signed')->first()->filepath}}" target="_blank" class="btn btn-primary mt-0">View Contract</a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <div class="alert-message">
                                <p><em class="ni ni-info me-1"></em>Contract successfully upload submitted to the Expert. Please wait for expert to upload the signed contract for this project.</p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="alert alert-warning alert-dismissible mb-1" role="alert">
                        <div class="alert-message">
                            <p><em class="ni ni-info me-1"></em>Contract for expert not uploaded yet. <a class="tw-text-blue-500 tw-cursor-pointer" onclick="createContract('expert')">Edit from default here</a></p>
                        </div>
                    </div>
                    <div class="form-control mt-0">
                        <label class="form-label" for="contract_expert">Contract for Expert</label>
                        <input type="file" class="form-control" id="contract_expert" placeholder="" value="">
                    </div>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div>
                <h6>Amount to be Received from Client</h6>
                @if($project->payment && $project->payment->where('received_status', 'pending')->first())
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="alert-message">
                            <p class="mb-0"><em class="ni ni-info me-1"></em>Payment of (<strong>{{$project->payment->received_amount}}</strong>) has been ask to be paid by client before the project completion.</p>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning alert-dismissible mb-1" role="alert">
                        <div class="alert-message">
                            <p><em class="ni ni-info me-1"></em>Amount to received from client</p>
                        </div>
                    </div>
                    <div class="form-control py-2">
                        <label for="payment_expert">Payment received from Client</label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <input type="text" class="form-control" id="client_amount" placeholder="Eg: 50000 USD">
                                <div class="input-group-append">
                                    <button  onclick="setAmount('client')" class="btn btn-info">Set Amount</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="mt-4">
                <h6>Set Expert Payment Amount</h6>
                @if($project->payment && $project->payment->where('released_status', 'pending')->first())
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="alert-message">
                            <p class="mb-0"><em class="ni ni-info me-1"></em>An amount of (<strong>{{$project->payment->released_amount}}</strong>) need to be released to Expert after project completion.</p>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning alert-dismissible mb-1" role="alert">
                        <div class="alert-message">
                            <p><em class="ni ni-info me-1"></em>Amount to be released to expert is not set yet.</p>
                        </div>
                    </div>
                    <div class="form-control py-2">
                        <label for="payment_expert">Payment to Expert after project Complete</label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <input type="text" class="form-control" id="expert_amount" placeholder="Eg: 50000 USD">
                                <div class="input-group-append">
                                    <button onclick="setAmount('expert')" class="btn btn-info">Set Amount</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-5">
            <h6>Contract Confirmation</h6>
            <div class="alert alert-light">
                <div class="form-control-wrap">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="contract_confirmation">
                        <label class="custom-control-label" for="contract_confirmation">I {{auth()->user()->name}} has check all the for requirement of contract and payment needed from the Client and Expert.</label>
                    </div>
                </div>
                <button id="start_button" class="btn btn-primary mt-2 disabled" onclick="startProject()">Start the Project</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modalContract">
    <div class="modal-dialog modal-xl" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contract_title">Create Contract</h5>
            </div>
            <div class="modal-body p-1">
                <div class="card-inner p-0">
                    <div class="tw-h-screen">
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
        $(document).ready(function(){
            let container = $('.tw-h-screen').height() - 370;
            $('.tw-h-screen').css('height', container);
        });

        let contract_type;
        function loadContract(){
            _Swal.loadingCallback('Load Contract...', 'Please wait while we load the default contract', 1000, function(){
                $.ajax({
                    url: '{{route('admin.contract.default', '')}}/'+contract_type,
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

        function createContract(type){
            contract_type = type;
            $('#contract_title').text(`Create ${type.charAt(0).toUpperCase() + type.slice(1)} Contract`);
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
                        location.reload();
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        });

        $('#contract_confirmation').on('change', function(){
            if($(this).is(':checked')){
                $('#start_button').removeClass('disabled');
            }else{
                $('#start_button').addClass('disabled');
            }
        });

        function startProject(){
            Swal.fire({
                title: 'Start Project?',
                text: 'This will mark the project as started and the expert can start working on the project. Confirm?',
                icon: 'info',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.start', '')}}/{{$project->pid}}',
                        method: 'PUT',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: response => {
                            Swal.fire('Project Started', response.message, 'success').then( () => {
                                location.reload();
                            });
                        },
                        error: response => {
                            Swal.fire('Error', response.responseJSON.message, 'error')
                        }
                    });
                }
            });

        }

        function setAmount(type){
            let amount = $('#'+type+'_amount').val();
            $.ajax({
                url: '{{route('admin.projects.payment_amount', '')}}/{{$project->pid}}',
                method: 'POST',
                data: {
                    amount: amount,
                    type: type,
                    _token: '{{csrf_token()}}'
                },
                success: response => {
                    Swal.fire('Amount Set', response.message, 'success').then( () => {
                        location.reload();
                    });
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        }
    </script>
@endpush
