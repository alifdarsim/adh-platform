@extends('layouts.others.main')

@section('content')

    <x-content_header title="Tags" subtitle="Total tags: {{$tags->count()}}"
                      :action="[['modal' => '#add_tags_modal', 'icon' => 'ni ni-plus', 'title' => 'Add New Tags']]"/>

    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table id="datatable" class="datatable-init-export nowrap table" data-export-title="Export">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Insert At</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td class="tw-align-middle">{{$tag->name}}</td>
                            <td class="tw-capitalize tw-align-middle">
                                <span
                                        class="tw-my-auto badge bg-{{$tag->status == 1 ? 'success' : 'danger'}}">{{$tag->status == 1 ? 'Active' : 'Inactive'}}</span>
                            </td>
                            <td class="tw-align-middle">{{$tag->created_at}}</td>
                            <td class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                               data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <div class="custom-control custom-switch ms-3 pt-2 pb-2">
                                                            <input onchange="changed({{$tag->id}})" type="checkbox"
                                                                   class="custom-control-input"
                                                                   id="customSwitch{{$tag->id}}" {{$tag->status == 1 ? 'checked' : ''}}>
                                                            <label class="custom-control-label fs-12px"
                                                                   for="customSwitch{{$tag->id}}">Status {{$tag->status == 1 ? 'Active' : 'Inactive'}}</label>
                                                        </div>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a class="tw-cursor-pointer"
                                                           onclick="remove('{{$tag->id}}')"><em
                                                                    class="icon ni ni-trash"></em><span>Delete Tag</span></a>
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


    <!-- Modal Form -->
    <div class="modal fade" id="add_tags_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register New Post Tags</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="tag-name">Tag Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="tag-name" required>
                        </div>
                    </div>
                    <div class="custom-control custom-control-lg custom-switch">
                        <input type="checkbox" class="custom-control-input" id="tag-status" checked>
                        <label class="custom-control-label" for="tag-status" id="tag-status-label">Set Active</label>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" onclick="insert_tag()"
                                class="btn btn-lg btn-primary bg-primary tw-float-right">Submit Tag
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script>
        let tag_status = $('#tag-status');

        function insert_tag() {
            let tag_name = $('#tag-name').val();
            let status = tag_status.is(':checked') ? 1 : 0;
            $.ajax({
                url: '{{route('tags.store')}}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    name: tag_name,
                    status: status
                },
                success: function () {
                    Swal.fire(
                        'Success!',
                        'Your tag has been added.',
                        'success'
                    ).then((result) => {
                        window.location.reload();

                    })
                }
            })
        }

        tag_status.on('change', function () {
            if (tag_status.is(':checked')) {
                $('#tag-status-label').text('Set Active');
            } else {
                $('#tag-status-label').text('Set Inactive');
            }
        });

        function remove(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will delete this tag!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('tags.destroy')}}',
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            id: id,
                        },
                        success: function () {
                            Swal.fire(
                                'Deleted!',
                                'Your tag has been deleted.',
                                'success'
                            ).then((result) => {
                                window.location.reload();

                            })
                        }
                    })
                }
            })
        }

        function changed(id) {
            let status = $('#customSwitch' + id).is(':checked') ? 1 : 0;
            Swal.fire({
                title: 'Are you sure?',
                text: 'Change status of this tag?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('tags.update')}}',
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: {
                            id: id,
                            status: status
                        },
                        success: function () {
                            Swal.fire(
                                'Changed!',
                                'Your tag has been changed.',
                                'success'
                            ).then((result) => {
                                window.location.reload();
                            })
                        }
                    })
                } else {
                    $('#customSwitch' + id).prop('checked', !status);
                }
            })
        }

    </script>
@endpush
