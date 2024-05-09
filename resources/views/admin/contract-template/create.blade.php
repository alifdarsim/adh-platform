@extends('layouts.admin.main')
@section('content')
    <style>
        .select2-dropdown {
            z-index: 9999999999 !important;
        }
    </style>
    <script src="/libs/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "#mytextarea",
            plugins: [
                "advlist", "autolink",  "lists", "link", "preview" , "table", "preview", "anchor", "searchreplace" , "visualblocks" , "code" , "fullscreen",
                "searchreplace" , "visualblocks" , "code" , "fullscreen",
            ],
            promotion: false,
            toolbar:
                "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
            height : "100%"
        });
    </script>
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title tw-capitalize">Create New Template Contract</h3>
                <div class="nk-block-des text-soft">
                    <p>Create the contract template</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt"><a onclick="saveContract()" class="btn btn-primary"><em class="icon ni ni-save"></em><span>Save Contract</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tw-h-[600px]">
        <textarea id="mytextarea" class="h-100"></textarea>
    </div>

@endsection

@push('scripts')
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });

        function saveContract(){
            Swal.fire({
                title: 'Save Contract',
                html: `
                <p class="mt-3">Which language do you want to save as?</p>
                <div class="form-group center mt-3">
                    <select class="form-select js-select2 tw-w-60" id="language" name="language">
                        <option value="en">🇺🇸 English</option>
                        <option value="zh">🇨🇳 中文</option>
                        <option value="ja">🇯🇵 日本語</option>
                        <option value="ms">🇲🇾 Bahasa Melayu</option>
                        <option value="ms">🇮🇩 Bahasa Indonesia</option>
                        <option value="ko">🇰🇷 한국어</option>
                        <option value="vi">🇻🇳 Tiếng Việt</option>
                        <option value="th">🇹🇭 ภาษาไทย</option>
                    </select>
                </div>`,
                showCancelButton: true,
                onOpen: () => {
                    $('.js-select2').select2();
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    const language = $('#language').val();
                    let content = tinymce.activeEditor.getContent();
                    $.ajax({
                        url: '{{route('admin.contract-template.store')}}',
                        method: 'POST',
                        data: {
                            contract: content,
                            language: language
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        datatype: 'json',
                        success: response => {
                            if (response.success) {
                                Swal.fire('Upload Success', response.message, 'success').then(() => {
                                    window.location.href = '{{route('admin.contract-template.index')}}';
                                });
                            }
                        },
                        error: response => {
                            Swal.fire('Error', response.responseJSON.message, 'error')
                        }
                    });
                }
            });
        }
    </script>
@endpush
