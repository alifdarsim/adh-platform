@extends('layouts.admin.main')
@section('content')

    <script src="/libs/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#mytextarea",
            plugins: [
                "export", "pagebreak", "advlist", "autolink",  "lists", "link", "preview" , "table", "preview", "anchor", "searchreplace" , "visualblocks" , "code" , "fullscreen",
                "searchreplace" , "visualblocks" , "code" , "fullscreen",
            ],
            promotion: false,
            toolbar:
                "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent pagebreak",
            height : "100%"
        });
    </script>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title tw-capitalize">Set Template Contract - (Language: {{$contract->language}})</h3>
                <div class="nk-block-des text-soft">
                    <p>Edit the template contract</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt"><a onclick="updateContract()" class="btn btn-primary"><em class="icon ni ni-save"></em><span>Save Contract</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tw-h-[600px]">
        <textarea id="mytextarea" class="h-100">{{$contract->content}}</textarea>
    </div>

@endsection

@push('scripts')
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });

        function updateContract(){
            let content = tinymce.activeEditor.getContent();
            console.log(content)
            $.ajax({
                url: '{{route('admin.contract-template.update', $contract->id)}}',
                method: 'PUT',
                data: {
                    contract: content
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                datatype: 'json',
                success: response => {
                    if (response.success) {
                        Swal.fire('Upload Success', response.message, 'success');
                    }
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        }
    </script>
@endpush
