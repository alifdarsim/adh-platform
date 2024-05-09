@extends('layouts.user.main')
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
                "pagebreak", "export", "autolink",  "lists", "link", "preview" ,
                "searchreplace" , "visualblocks" , "code" , "fullscreen",
            ],
            branding: false,
            toolbar:
                "",
            height : "100%",
            setup: function(editor) {
                editor.on('init', function() {
                    changeContent();
                });
            }
        });
    </script>


    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    <a class="back" href="javascript:history.back()"><i class="fa-solid fa-arrow-left me-1 fs-4"></i></a>
                    Sign Contract</h3>
                <div class="nk-block-des text-soft">
                    <p>View and Sign your project agreement before proceed working on the project.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="tw-grid tw-grid-cols-12 tw-gap-4">
            <div class="card card-bordered tw-col-span-12 tw-max-w-5xl">
                <div class="card-inner">
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <div class="tw-h-[900px]">
                                    <textarea id="mytextarea" class="h-100">{{$contract_expert->template->content}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-bordered tw-col-span-4 d-none">
                <div class="card-inner">
                    <div class="card-title card-title-sm"><h6 class="title">Contract Details</h6><p>Fill-up contract information and Sign the document.</p></div>
                    <div class="nk-block">
                        <div class="row gy-2">
                            <div class="col-12">
                                <div class="form-group d-none">
                                    <label class="form-label" for="project_title">Project Title</label>
                                    <div class="form-control-wrap">
                                        <textarea name="project_title" id="project_title" class="form-control !tw-min-h-[64px]" disabled>{{$contract_expert->project_expert->project->name}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="expert_name">Expert Name</label>
                                    <div class="form-control-wrap">
                                        <input name="project_title" id="expert_name" class="form-control" placeholder="Eg: John Doe" value="{{$contract_expert->project_expert->expert->name}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="expert_address">Expert Address</label>
                                    <div class="form-control-wrap">
                                        <textarea name="project_title" id="expert_address" class="form-control !tw-min-h-[64px]">{{$contract_expert->project_expert->expert->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group d-none">
                                    <label class="form-label" for="scope_work">Scope of Work</label>
                                    <div class="form-control-wrap">
                                        <textarea name="project_title" id="scope_work" class="form-control">{{$contract_expert->scope_work}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-none">
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
                            <div class="col-12 d-none">
                                <div class="form-group">
                                    <label class="form-label">Dateline</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control date-picker">
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-12">--}}
{{--                                <div class="form-group">--}}
{{--                                    <button class="btn btn-success" onclick="saveChanges()" >Save Changes</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-12 d-none">
                                <div class="form-group">
                                    <label class="form-label" for="adh_pic">ADH PIC</label>
                                    <div class="form-control-wrap">
                                        <input name="adh_pic" id="adh_pic" class="form-control" placeholder="Eg: John Doe" value="{{$contract_expert->adh_pic ?? 'Toshiro Takekoshi'}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-none">
                                <div class="form-group">
                                    <label class="form-label" for="adh_pic">Date</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control date-picker2">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-none">
                                <div class="form-group">
                                    <label class="form-label" for="adh_pic">Signature</label>
                                    <div class="card card-bordered" style="width: 200px;">
                                        <img class="tw-border tw-border-amber-500" id="signature_image" src="{{asset('assets/images/signature.svg')}}" style="width: 200px; height: 100px;"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label" for="adh_pic">Signature</label>
                                    <div class="card card-bordered" style="width: 200px;">
                                        <img class="tw-border tw-border-amber-500" id="expert_signature_image" src="{{$contract_expert->expert_signature ?? asset('assets/images/blank_signature.svg')}}" style="width: 200px; height: 100px;"/>
                                        <button data-bs-toggle="modal" data-bs-target="#modalTabs" class="btn btn-sm btn-outline-light tw-justify-center" style="width: 200px;">Edit E-Signature</button>
                                    </div>
                                    <button onclick="signedDocument()" class="btn btn-outline-info mt-3">Sign</button>
                                </div>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="form-group">
                                    <label class="form-label">Submit Signed Contract</label>
                                    <div class="form-control-wrap">
                                        <button onclick="submitDocument()" class="btn btn-success">Submit Document</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalTabs">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Sign Contract</h4>
                    <ul class="nk-nav nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">E-Sign</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Type Sign</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tabItem3">Upload Image</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabItem1">
                        </div>
                        <div class="tab-pane" id="tabItem2">
                            <input type="text" class="form-control" id="type_expert_signature" placeholder="Type your sign here"/>
                        </div>
                        <div class="tab-pane" id="tabItem3">
                            <input type="file" class="form-control" id="upload_expert_signature"/>
                        </div>
                    </div>
                    <div id="signature-pad" class="signature-pad mt-2">
                        <div class="signature-pad--body">
                            <canvas width="640" height="313"></canvas>
                            <div>
                                <button class="btn btn-primary mt-3" onclick="clearSign()">Clear</button>
                                <button class="btn btn-success mt-3" onclick="saveSign()">Save Sign</button>
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

        let contract_status = '{{$contract_expert->status}}';

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
            if (contract_status === 'submitted'){
                signedDocument();
            }
        }

        function adminPlaceholderInit(){
            let content = tinymce.activeEditor.getContent();
            content = content.replaceAll('[ADH_SIGNATURE]', `<span style="font-style: italic;">[ADH_SIGNATURE]</span>`);
            tinymce.activeEditor.setContent(content);
        }

        function signedDocument(){
            let content = tinymce.activeEditor.getContent();
            let signatureImage = $('#expert_signature_image').attr('src');
            content = content.replaceAll('<span id="expert_signature"></span>', `<img src="${signatureImage}" style="width: 200px; height: 100px;"/>`);
            content = content.replaceAll('<span id="expert_signed_date"></span>', `<span style="font-style: italic">${moment().format('DD/MM/YYYY')}</span>`);
            tinymce.activeEditor.setContent(content);
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
                            dateline_signed: moment(dateline_signed, 'DD/MM/YYYY').format('YYYY-MM-DD'),
                            adh_signature: signatureImage,
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response){
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
                        }
                    });
                }
            });
        }

        function expertPlaceholderInit(){
            let content = tinymce.activeEditor.getContent();
            content = content.replaceAll('[EXPERT_SIGNATURE]', `<span id="expert_signature"></span>`);
            content = content.replaceAll('[EXPERT_SIGNED_DATE]', `<span id="expert_signed_date"></span>`);
            tinymce.activeEditor.setContent(content);
        }

        function submitDocument(){
            let expert_name = $('#expert_name').val();
            let expert_address = $('#expert_address').val();
            let expert_signature = $('#expert_signature_image').attr('src');
            let expert_signed_date = moment().format('YYYY-MM-DD');
            $.ajax({
                url: '{{route('expert.contract.update', $contract_expert->contract_id)}}',
                method: 'PUT',
                data: {
                    expert_name: expert_name,
                    expert_address: expert_address,
                    expert_signature: expert_signature,
                    expert_signed_date: expert_signed_date
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response){
                    Swal.fire({
                        title: 'Success',
                        text: 'Contract submitted successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        window.location.reload();
                    });
                }
            });
        }

    </script>
    <script>
        const wrapper = document.getElementById("signature-pad");
        const canvas = wrapper.querySelector("canvas");
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)'
        });
        signaturePad.penColor = 'blue';

        function clearSign(){
            signaturePad.clear();
        }

        function saveSign(){
            let data = signaturePad.toDataURL('image/png');
            $('#expert_signature_image').attr('src', data);
            $('#expert_signature').val(data);
            $('#modalTabs').modal('hide');
        }

        $('#type_expert_signature').on('change', function(){
            let data = $('#type_expert_signature').val();
            // make canvas blank
            signaturePad.clear();
            // draw text on canvas
            renderTextOnCanvas(canvas, data, undefined, undefined, canvas.height / 2);
        });

        function renderTextOnCanvas(canvas, text, fontFace = 'Signeritta', maxFontSize = 300, yPosition) {
            const ctx = canvas.getContext('2d');
            let fontSize = maxFontSize;

            do {
                fontSize--;
                ctx.font = `${fontSize}pt ${fontFace}`;
            } while (ctx.measureText(text).width > canvas.width);

            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.textBaseline = 'middle';
            ctx.textAlign = 'center';
            ctx.fillText(text, canvas.width / 2, yPosition);
        }

        $('#upload_expert_signature').on('change', function(){
            let file = $('#upload_expert_signature')[0].files[0];
            let reader = new FileReader();
            reader.onload = function(e) {
                let data = e.target.result;
                signaturePad.clear();
                renderImageOnCanvas(canvas, data);
            };
            reader.readAsDataURL(file);

        });

        function renderImageOnCanvas(canvas, data){
            const ctx = canvas.getContext('2d');
            let image = new Image();
            image.src = data;
            image.onload = function(){
                ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
            };
        }


    </script>

@endpush
