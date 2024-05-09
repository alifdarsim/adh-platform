@extends('layouts.admin.main')
@section('content')
    <style>
        .tox-editor-header {
            display: none !important;
        }
    </style>
    <script src="/libs/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#mytextarea",
            readonly: true,
            plugins: [
                "export",
            ],
            branding: false,
            toolbar:
                "",
            height : "100%",
            setup: function(editor) {
                editor.on('init', function() {
                    changeContent();
                    let screenHeight = window.innerHeight;
                    let minHeight = 250;
                    let rightContent = $('#right_content').height();
                    let newHeight = screenHeight - minHeight;
                    if (newHeight < rightContent) {
                        newHeight = rightContent;
                    }
                    document.querySelector('.tox-tinymce').style.height = `${newHeight}px`;
                });
            }
        });
    </script>


    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"> <a class="back" href="javascript:history.back()"><i
                            class="fa-solid fa-arrow-left me-2 fs-4"></i></a> Sign Contract</h3>
                <div class="nk-block-des text-soft">
                    <p>Set the contract details, sign the contract and approve it. User will be notify once the contract is approved.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
{{--                            <li>--}}
{{--                                <div class="drodown">--}}
{{--                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-info" data-bs-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-plus"></em><span>Add On</span><em class="dd-indc icon ni ni-chevron-right"></em></a>--}}
{{--                                    <div class="dropdown-menu dropdown-menu-end">--}}
{{--                                        <ul class="link-list-opt no-bdr">--}}
{{--                                            <li><a href="#"><span>View as PDF</span></a></li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}
                            <li class="nk-block-tools-opt d-none d-sm-block">
                                <button onclick="viewPdf()" class="btn btn-outline-info bg-white"><em class="icon ni ni-file"></em><span>View as PDF</span></button>
                            </li>
{{--                            <li class="nk-block-tools-opt d-none d-sm-block">--}}
{{--                                <button onclick="approveContract()" class="btn btn-primary {{$contract_expert->status == 'submitted' ? 'disabled' : ''}}"><em class="icon ni ni-check"></em><span>Approve Contract</span></button>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="nk-block">
        <div class="tw-grid tw-grid-cols-12 tw-gap-4">
            <div class="tw-col-span-8">
                <textarea id="mytextarea" class="">{{$contract_expert->template->content}}</textarea>
            </div>
            <div id="right_content" class="card card-bordered tw-col-span-4">
                <div class="card-inner pt-1">
                    <div class="nk-block">
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label class="form-label" for="contract_status">Contract Status</label>
                                <div class="form-control-wrap">
                                    <input name="contract_status" id="contract_status" class="form-control mb-2 tw-capitalize text-white {{$contract_expert->status === 'pending' ? 'bg-warning' : ($contract_expert->status === 'approved' ? 'bg-info' : 'bg-success')}}" placeholder=""
                                           value="{{$contract_expert->status == 'approved' ? 'Waiting expert to sign document' : $contract_expert->status}}"
                                           disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="divider mb-0" style="margin: 1rem 0;"></div>
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Details</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tabItem3">Template</a></li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Approval</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabItem1">
                                <div class="row gy-2">

                                    <div class="col-12 d-none">
                                        <div class="form-group">
                                            <label class="form-label" for="project_title">Project Title</label>
                                            <div class="form-control-wrap">
                                                <textarea name="project_title" id="project_title" class="form-control !tw-min-h-[64px]" disabled>{{$contract_expert->project_expert->project->name}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none">
                                        <div class="form-group">
                                            <label class="form-label" for="expert_name">Expert Name</label>
                                            <div class="form-control-wrap">
                                                <input name="project_title" id="expert_name" class="form-control" placeholder="Eg: John Doe" value="{{$contract_expert->project_expert->expert->name}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-none">
                                        <div class="form-group">
                                            <label class="form-label" for="expert_address">Expert Address</label>
                                            <div class="form-control-wrap">
                                                <textarea name="project_title" id="expert_address" class="form-control !tw-min-h-[64px]">{{$contract_expert->project_expert->expert->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="scope_work">Scope of Work</label>
                                            <div class="form-control-wrap">
                                                <textarea name="project_title" id="scope_work" class="form-control">{{$contract_expert->scope_work}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="fee">Payment Fee</label>
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap  tw-w-[120px]">
                                                                <select name="currency" id="currency" data-search="on" class="form-select js-select2">
                                                                    @foreach($currencies as $currency)
                                                                        <option value="{{$currency->currency}}"
                                                                            {{
                                                                                (empty($contract_expert->currency) && $currency->currency == 'USD')
                                                                                || $contract_expert->currency == $currency->currency ? 'selected' : ''
                                                                            }}>
                                                                            {{$currency->currency}} ({{$currency->currency_symbol}})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input name="project_title" id="fee" class="form-control" placeholder="Eg: 500" value="{{$contract_expert->fee}}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Dateline</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control date-picker">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button class="btn btn-success" onclick="saveChanges()" >Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabItem2">
                                <div class="col-12 mt-1">
                                    <div class="form-group">
                                        <label class="form-label" for="adh_pic">ADH PIC</label>
                                        <div class="form-control-wrap">
                                            <input name="adh_pic" id="adh_pic" class="form-control" placeholder="Eg: John Doe" value="{{$contract_expert->adh_pic ?? 'Toshiro Takekoshi'}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="form-group">
                                        <label class="form-label" for="adh_pic">Date</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control date-picker2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <div class="form-group">
                                        <label class="form-label" for="adh_pic">Signature</label>
                                        <div class="card card-bordered" style="width: 200px;">
                                            <img class="tw-border tw-border-amber-500" id="signature_image" src="{{asset('signatures/signatures.png')}}" style="width: 200px; height: 100px;"/>
                                            <button onclick="changeSinged()" class="btn btn-sm btn-outline-light tw-justify-center" style="width: 200px;">Change Default Signature</button>
                                        </div>
                                        <button onclick="signedDocument()" class="btn btn-success mt-3">Sign & Approve</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabItem3">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                    <tr>
                                        <th class="px-2" scope="col">Language</th>
                                        <th class="px-2" scope="col">Ver.</th>
                                        <th class="px-2" scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($templates as $template)
                                        <tr>
                                            <td class="px-2 pt-2 language-code">{{$template->language}}</td>
                                            <td class="px-2 tw-capitalize pt-2">{{$template->version}}</td>
                                            <td class="px-2 d-flex">
                                                <button onclick="viewTemplate({{$template->id}})" class="btn btn-sm btn-outline-info">View</button>
                                                <button onclick="useTemplate({{$template->id}})" class="btn btn-sm btn-success ms-1">Apply</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script>
        $('.date-picker').val('{{Carbon\Carbon::parse($contract_expert->dateline)->format('d/m/Y')}}').datepicker({
            format: 'dd/mm/yyyy',
            autoHide: true,
        });

        $('.date-picker2').val('{{Carbon\Carbon::parse($contract_expert->adh_sign_date)->format('d/m/Y')}}').datepicker({
            format: 'dd/mm/yyyy',
            autoHide: true,
        });

        $('#scope_work').on('change', function(){
            changeContent();
        });

        $('#adh_pic').on('change', function(){
            changeContent();
        });

        $( "#project_title" ).on( "change", function() {
            changeContent();
        });

        $( "#expert_name" ).on( "change", function() {
            changeContent();
        });

        $( "#expert_address" ).on( "change", function() {
            changeContent();
        });

        $( "#fee" ).on( "change", function() {
            changeContent();
        });

        $( "#currency" ).on( "change", function() {
            changeContent();
        });

        $( ".date-picker" ).on( "change", function() {
            changeContent();
        });

        $( ".date-picker2" ).on( "change", function() {
            changeContent();
        });

        function saveChanges(){
            let scope_work = $('#scope_work').val();
            let fee = $('#fee').val();
            let currency = $('#currency').val();
            let dateline = $('.date-picker').val();
            $.ajax({
                url: '{{route('admin.contract.update', $contract_expert->contract_id)}}',
                method: 'PUT',
                data: {
                    scope_work: scope_work,
                    fee: fee,
                    currency: currency,
                    dateline: moment(dateline, 'DD/MM/YYYY').format('YYYY-MM-DD')
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response){
                    Swal.fire({
                        title: 'Success',
                        text: 'Contract updated successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });
                }
            });
        }

        let fixedContent = `{!! $contract_expert->template->content !!}`;
        function changeContent(){
            let scope_title = $('#project_title').val();
            let expert_name = $('#expert_name').val();
            let expert_address = $('#expert_address').val();
            let scope_work = $('#scope_work').val();
            scope_work = scope_work.replace(/\n/g, '<br>');
            let fee = $('#fee').val();
            let currency = $('#currency').val();
            fee = `${currency} ${fee}`;
            let dateline = $('.date-picker').val();
            let dateline_signed = $('.date-picker2').val();
            let adh_pic = $('#adh_pic').val();
            let content = fixedContent;
            if (scope_title !== '') content = content.replaceAll('[PROJECT_TITLE]', scope_title);
            if (expert_name !== '') content = content.replaceAll('[EXPERT_NAME]', expert_name);
            if (expert_address !== '') content = content.replaceAll('[EXPERT_ADDRESS]', expert_address);
            if (scope_work !== '') content = content.replaceAll('[SCOPE_OF_WORK]', scope_work);
            if (fee !== '') content = content.replaceAll('[FEE]', fee);
            if (dateline !== '') content = content.replaceAll('[DATELINE]', dateline);
            if (dateline_signed !== '') content = content.replaceAll('[ADH_SIGNED_DATE]', dateline_signed);
            if (adh_pic !== '') content = content.replaceAll('[ADH_PIC]', adh_pic);
            let signatureImage = $('#signature_image').attr('src');
            let adh_signature = '{{$contract_expert->adh_signature}}';
            if (adh_signature !== '') content = content.replaceAll('[ADH_SIGNATURE]', `<img src="${adh_signature}" style="width: 200px; height: 100px;"/>`);
            tinymce.activeEditor.setContent(content);
            expertPlaceholderInit();
            adminPlaceholderInit();
        }

        function adminPlaceholderInit(){
            let content = tinymce.activeEditor.getContent();
            content = content.replaceAll('[ADH_SIGNATURE]', `<span style="font-style: italic;">[ADH_SIGNATURE]</span>`);
            tinymce.activeEditor.setContent(content);
        }

        function signedDocument(){
            let content = tinymce.activeEditor.getContent();
            let defaultSign = '{{asset('signatures/signatures.png')}}';
            content = content.replaceAll('[ADH_SIGNATURE]', `<img src="${defaultSign}" style="width: 200px; height: 100px;"/>`);
            content = content.replaceAll('[ADH_PIC]', $('#adh_pic').val());
            content = content.replaceAll('[ADH_SIGNED_DATE]', $('.date-picker2').val());
            tinymce.activeEditor.setContent(content);
            saveSignedDocument();
        }

        function saveSignedDocument(){
            // prompt user to approve the signed document
            Swal.fire({
                title: 'Sign & Save Document?',
                text: "Sign and save this contract?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let adh_pic = $('#adh_pic').val();
                    let dateline_signed = $('.date-picker2').val();
                    let signatureImage = tinymce.activeEditor.getContent().match(/<img[^>]+>/g)[0];
                    // get src attribute from img tag
                    signatureImage = signatureImage.match(/src="([^"]+)"/)[1];
                    $.ajax({
                        url: '{{route('admin.contract.update', $contract_expert->contract_id)}}',
                        method: 'PUT',
                        data: {
                            adh_pic: adh_pic,
                            dateline: moment(dateline_signed, 'DD/MM/YYYY').format('YYYY-MM-DD'),
                            adh_signature: signatureImage,
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response){
                            approveContract();
                        }
                    });
                }
            });

        }

        function expertPlaceholderInit(){
            let content = tinymce.activeEditor.getContent();
            content = content.replaceAll('[EXPERT_SIGNATURE]', `<span style="font-style: italic"></span>`);
            content = content.replaceAll('[EXPERT_SIGNED_DATE]', `<span style="font-style: italic"></span>`);
            tinymce.activeEditor.setContent(content);
        }

        function useTemplate(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to use this template?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, use it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.contract.update', $contract_expert->contract_id)}}',
                        method: 'PUT',
                        data: {
                            template_id: id
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response){
                            window.location.reload();
                        }
                    });
                }
            });

        }

        function viewTemplate(id){
            window.open(`{{route('admin.contract-template.show','')}}/${id}`, '');
        }

        function approveContract(){
            // prompt user to approve the signed document
            Swal.fire({
                title: 'Approve contract?',
                text: "Signed contract is success proceed to approve this contract? Once you approve, you cannot edit the contract anymore.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.contract.update', $contract_expert->contract_id)}}',
                        method: 'PUT',
                        data: {
                            status: 'approved'
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response){
                            window.location.reload();
                        }
                    });
                }
            });
            {{--Swal.fire({--}}
            {{--    title: 'Are you sure?',--}}
            {{--    text: "You want to approve this contract?",--}}
            {{--    icon: 'warning',--}}
            {{--    showCancelButton: true,--}}
            {{--    confirmButtonColor: '#3085d6',--}}
            {{--    cancelButtonColor: '#d33',--}}
            {{--    confirmButtonText: 'Yes, approve it!'--}}
            {{--}).then((result) => {--}}
            {{--    if (result.isConfirmed) {--}}
            {{--        $.ajax({--}}
            {{--            url: '{{route('admin.contract.update', $contract_expert->contract_id)}}',--}}
            {{--            method: 'PUT',--}}
            {{--            data: {--}}
            {{--                status: 'approved'--}}
            {{--            },--}}
            {{--            headers: {--}}
            {{--                'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
            {{--            },--}}
            {{--            success: function(response){--}}
            {{--                window.location.reload();--}}
            {{--            }--}}
            {{--        });--}}
            {{--    }--}}
            {{--});--}}
        }

        function changeSinged(){
            Swal.fire({
                title: 'Change Default Signature',
                text: "Upload a signature file to replace the default signature",
                input: 'file',
                inputAttributes: {
                    accept: 'image/*',
                    'aria-label': 'Upload your signature'
                },
                showCancelButton: true,
                confirmButtonText: 'Upload',
                showLoaderOnConfirm: true,
                preConfirm: (file) => {
                    let formData = new FormData();
                    formData.append('signature', file);
                    $.ajax({
                        url: '{{route('admin.contract.change_signature')}}',
                        method: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        contentType: false,
                        processData: false,
                        success: function(response){
                            let default_signature_url = '{{asset('signatures/signatures.png')}}';
                            $('#signature_image').attr('src', default_signature_url);
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }

        function viewPdf(){
            // download pdf from tinymce content
            tinymce.activeEditor.plugins.export.download('clientpdf', {});
        }

        $(document).ready(function(){
            $('.language-code').each(function(){
                let code = $(this).text();
                let lang = getLanguageEmoji(code)
                $(this).text(lang);
            });
        });
    </script>

@endpush
