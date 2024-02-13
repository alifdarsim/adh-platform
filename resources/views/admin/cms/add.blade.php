@extends('layouts.others.main')
@section('content')

    <script src="https://cdn.tiny.cloud/1/bgf7byzvkiwldv49iykgo7wkqnjhngjq0usafjod6sybr2id/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>

    <x-content_header title="Add New Page"
                      subtitle="Create your Article/ Blog/ Use Case to show to Asia Deal Hub Website"/>

    <div class="nk-block">
        <div class="row g-gs">

            <div class="col-lg-4">
                <div class="card card-bordered">
                    <div class="card-inner" id="side-post">
                        <div class="row g-2">
                            <div class="col-lg-12 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="pageType">Select Page Type</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" data-placeholder="Status" id="pageType">
                                            <option value="blogs">Blogs</option>
                                            <option value="article">Article</option>
                                            <option value="case_studies">Case Studies</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="addTitle">Title</label>
                                    <input type="text" class="form-control" id="addTitle" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="addSlug">Slug (Url endpoint)</label>
                                    <input type="text" class="form-control" id="addSlug" placeholder="Slug">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="addTag">Tags</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" multiple="multiple"
                                                data-placeholder="Tags" id="addTag">
                                            @foreach($tags as $tag)
                                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Featured Image (Banner)</label>
                                    <div class="tw-border tw-h-44 tw-flex tw-items-center tw-justify-center">
                                        <button id="image_button" onclick="uploadImage()" class="btn btn-primary">Upload
                                            Image
                                        </button>
                                        <input class="form-control !tw-hidden" type="file" id="formFile"
                                               onchange="preview()">
                                        <img id="image_holder" src="" class="!tw-hidden tw-h-full tw-w-full"
                                             alt="feature_image"/>
                                    </div>
                                    <button id="cancel_image_button" onclick="resetImage()"
                                            class="!tw-hidden mt-1 btn btn-light btn-sm float-end">Reset Image
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="addDate">Date</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input type="text" class="form-control date-picker" id="addDate"
                                               data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="pageAuthor">Select Author</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" data-placeholder="Author"
                                                id="pageAuthor">
                                            @foreach($authors as $author)
                                                <option value="{{$author->id}}">{{$author->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="pageStatus">Select Status</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" data-placeholder="Status"
                                                id="pageStatus">
                                            <option value="published">Published</option>
                                            <option value="archived">Archived</option>
                                            <option value="draft">Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 mt-1">
                                        <li>
                                            <button id="submitBtn" class="btn btn-primary">Publish Post</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->

            <div class="col-lg-8">
                <div class="card card-bordered tw-h-full">
                    <div class="card-inner">
                        <x-tinymce-editor/>
                    </div>
                </div><!-- .card -->
            </div><!-- .col -->

        </div><!-- .row -->
    </div>

@endsection

@push('scripts')
    <script>
        // $('.date-picker').datepicker('setDate', new Date());
        // $('#addTitle').val('This is a sample title');
        // $('#addSlug').val('this-is-a-sample-title');
        // $('#addTag').val([2, 3]).trigger('change');

        // create a typing change event for the title
        $('#addTitle').on('keyup', e => {
            let title = $('#addTitle').val();
            let slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#addSlug').val(slug);
        });

        function resetImage() {
            document.getElementById("image_holder").classList.add('!tw-hidden');
            document.getElementById("cancel_image_button").classList.add('!tw-hidden');
            document.getElementById("image_button").classList.remove('!tw-hidden');
            document.getElementById("formFile").value = "";
        }

        function uploadImage() {
            document.getElementById("formFile").click();
        }

        function preview() {
            let oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("formFile").files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("image_button").classList.add('!tw-hidden');
                document.getElementById("image_holder").classList.remove('!tw-hidden');
                document.getElementById("image_holder").src = oFREvent.target.result;
                document.getElementById("cancel_image_button").classList.remove('!tw-hidden');
            };
        }

        // get publish button and add event listener
        $('#submitBtn').click(e => {
            let content = tinymce.activeEditor.getContent();
            let formData = new FormData();
            formData.append('content', content);
            formData.append('type', $('#pageType').val());
            formData.append('title', $('#addTitle').val());
            formData.append('slug', $('#addSlug').val());
            formData.append('post_date', $('#addDate').val());
            formData.append('status', $('#pageStatus').val());
            formData.append('tags', $('#addTag').val());
            formData.append('author_id', $('#pageAuthor').val());
            formData.append('image', $('#formFile').prop('files')[0]);

            // send the form page_adddata to the server
            $.ajax({
                url: '{{route('post.store')}}',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                datatype: 'json',
                processData: false,
                contentType: false,
                success: response => {
                    if (response.success) {
                        Swal.fire('Upload Success', response.message, 'success');
                        setTimeout(() => window.location.href = '{{route('post.show')}}', 1000);
                    }
                },
                error: response => {
                    Swal.fire('Error', response.responseJSON.message, 'error')
                }
            });
        });
    </script>
@endpush
