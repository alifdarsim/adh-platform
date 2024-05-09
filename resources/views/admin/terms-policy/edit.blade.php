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
                <h3 class="nk-block-title page-title tw-capitalize">
                    <a class="back" href="javascript:history.back()"><i class="fa-solid fa-arrow-left me-1 fs-4"></i></a>
                    Edit {{$types}} - (<span id="language_text"></span>)</h3>
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
        <textarea id="mytextarea" class="h-100">{{$policy->content}}</textarea>
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
                url: '{{route('admin.terms-policy.update', $policy->id)}}',
                method: 'PUT',
                data: {
                    content: content
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
        $('#language_text').text(getLanguageEmoji('{{$policy->language}}'));

    </script>
@endpush
