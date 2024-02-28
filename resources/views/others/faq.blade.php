@php
    $content = \App\Models\EditorPolicy::where('type', 'faq')->first()->content;
@endphp
@extends('layouts.others.terms')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block">
            <div class="nk-block-head-content text-center">
                <h2 class="text-dark">Frequency Asked Questions</h2>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner" id="tiny_mce_holder" style="display: none">
                <textarea class="tinymce-basic form-control ">{{$content}}</textarea>
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
                plugins: "autoresize",
                readonly: true, // Set to true to make the editor read-only
                toolbar: false, // Hide the toolbar
                menubar: false, // Hide the menubar
                toolbar_sticky: false, // Disable sticky toolbar
                statusbar: false, // Hide the status bar
                autoresize_bottom_margin: 10,
                init_instance_callback : "initInstance"
            });
        }

        function initInstance(inst) {
            $('#tiny_mce_holder').css('display', 'block');
        }

    </script>
@endpush



