@props([
    'content'
])
<script {{ $attributes }}>
    tinymce.init({
        selector: '#tinymce',
        menubar: false,
        content_css: 'writer',
        plugins: 'preview anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        toolbar: [
            'blocks fontfamily fontsize | bold italic underline strikethrough removeformat',
            'preview link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap'
        ],
        toolbar_sticky: true,
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        height: 700,
        convert_urls: false,
        /* without images_upload_url set, Upload tab won't show up*/
        images_upload_url: '/cms/tinymce/image_upload',
    })

</script>
<div id="tinymce">
    {!! isset($content) ? $content : "Write your post here" !!}
</div>
