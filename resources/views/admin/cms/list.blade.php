@extends('layouts.others.main')
@section('content')

    <x-content_header title="Post List" subtitle="Total post: {{$pages->count()}} post"
                      :action="[['link' => route('post.create'), 'icon' => 'ni ni-plus', 'title' => 'Add New Post']]"/>

    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table id="datatable" class="datatable-init-export nowrap table" data-export-title="Export">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Author</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Title</span></th>
                        <th class="nk-tb-col tb-col-mb"><span class="sub-text">Category</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Insert At</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td class="nk-tb-col">
                                <div class="user-card">
                                    <div class="tw-h-7 tw-w-7 user-avatar bg-dim-primary d-none d-sm-flex !tw-mr-2">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-info">
                                        <span>{{$page->author->name}}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="tw-align-middle">{{$page->title}}</td>
                            <td class="tw-capitalize tw-align-middle">{{$page->type}}</td>
                            <td class="tw-capitalize tw-align-middle">
                                <span
                                        class="tw-my-auto badge bg-{{$page->status == 'published' ? 'success' : ($page->status == 'draft' ? 'warning' : 'secondary')}}">{{$page->status}}
                                </span>
                                @if ($page->featured == 1)
                                    <span class="tw-my-auto badge bg-primary">Featured</span>
                                @endif
                            </td>
                            <td class="tw-align-middle">{{$page->created_at}}</td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                               data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a class="tw-cursor-pointer"
                                                           onclick="quick_view('{{$page->id}}')">
                                                            <em class="icon ni ni-eye"></em><span>Quick View</span></a>
                                                    </li>
                                                    <li><a href="{{$page->url}}" target="_blank"
                                                           rel="noopener noreferrer"><em
                                                                    class="icon ni ni-article"></em><span>To Post</span></a>
                                                    </li>
                                                    <li><a href="{{route('post.edit', ["id" => $page->id])}}"><em
                                                                    class="icon ni ni-edit"></em><span>Edit Post</span></a>
                                                    </li>
                                                    <li><a class="tw-cursor-pointer"
                                                           onclick="remove('{{$page->id}}')"><em
                                                                    class="icon ni ni-trash"></em><span>Delete Post</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modalLarge">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Post Quick View</h5>
                    <a class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer bg-light">
                    <p class="sub-text">This is for quick preview only. To view actual content please go to post.
                        <a href="{{$page->url}}" class="tw-underline tw-text-blue-500 ms-1">View Post</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script>
        function quick_view(id) {
            $.ajax({
                url: "{{route('post.quick_view')}}",
                type: 'GET',
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    $('#modalLarge').modal('show')
                    $('#modalLarge .modal-body').html(data);
                },
                error: function (xhr) {
                    Swal.fire('Error!', 'Something went wrong.', 'error')
                }
            });
        }

        function remove(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning', showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('post.destroy')}}",
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function () {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(() => window.location.reload())
                        },
                        error: function (xhr) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            )
                        }
                    });

                }
            })
        }

        $(document).ready(function () {

        });
    </script>
@endpush
