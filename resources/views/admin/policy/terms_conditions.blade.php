@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Terms and Use Conditions Editor</h3>
                <div class="nk-block-des text-soft">
                    <p>Edit and manage the terms and use conditions here.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <a href="{{route('others.terms')}}" target="_blank" class="btn btn-white btn-outline-primary"><em class="icon ni ni-eye"></em><span>View Terms & Condition</span></a>
                <a onclick="updateEditor()" class="btn btn-white btn-primary"><em class="icon ni ni-upload"></em><span>Update</span></a>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner h-100">
                <textarea class="tinymce-basic form-control tw-h-full">{{$content}}</textarea>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <link rel="stylesheet" href="/assets/css/editors/tinymce.css?ver=3.2.3">
    <script src="/assets/js/libs/editors/tinymce.js?ver=3.2.3"></script>
    <script>
        let _tinymce_basic = '.tinymce-basic';

        if ($(_tinymce_basic).exists()) {
            tinymce.init({
                selector: _tinymce_basic,
                autoresize_bottom_margin: 10,
                plugins: "autoresize",
                init_instance_callback : "initInstance"
            });
        }

        function initInstance(inst) {
            $('#tiny_mce_holder').css('display', 'block');
        }

        function updateEditor(){
            // change height of the editor
            let content = tinyMCE.activeEditor.getContent();
            updateData(content);
        }

        function updateData(content){
            $.ajax({
                url: '{{route('admin.editor.update', 'privacy-policy')}}',
                type: 'PUT',
                data: {
                    _token: '{{csrf_token()}}',
                    content: content
                },
                success: function (response) {
                    console.log(response);
                    _Swal.success('Terms & Conditions Updated!', 'Terms & Conditions has been updated successfully!')
                },
                error: function (error) {
                    _Swal.error('Error!', 'Something went wrong, please try again later!')
                }
            });
        }
    </script>
@endpush
