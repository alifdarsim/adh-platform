@extends('layouts.others.main')

@section('content')

    <x-content_header title="Authors List" subtitle="Total Authors: {{$authors->count()}}"
                      :action="[['modal' => '#add_tags_modal', 'icon' => 'ni ni-plus', 'title' => 'Add New Authors']]"/>

    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table id="datatable" class="datatable-init-export nowrap table" data-export-title="Export">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Position</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Company</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Post Count</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Insert At</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td class="tw-align-middle">{{$author->name}}</td>
                            <td class="tw-align-middle">{{$author->position}}</td>
                            <td class="tw-align-middle">{{$author->company}}</td>
                            <td class="tw-align-middle">{{$author->posts->count()}}</td>
                            <td class="tw-capitalize tw-align-middle">
                                <span
                                        class="tw-my-auto badge bg-{{$author->status == 1 ? 'success' : 'danger'}}">{{$author->status == 1 ? 'Active' : 'Inactive'}}</span>
                            </td>
                            <td class="tw-align-middle">{{$author->created_at}}</td>
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
                                                            <input onchange="changed({{$author->id}})" type="checkbox"
                                                                   class="custom-control-input"
                                                                   id="customSwitch{{$author->id}}" {{$author->status == 1 ? 'checked' : ''}}>
                                                            <label class="custom-control-label fs-12px"
                                                                   for="customSwitch{{$author->id}}">Status {{$author->status == 1 ? 'Active' : 'Inactive'}}</label>
                                                        </div>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li><a class="tw-cursor-pointer"
                                                           onclick="remove('{{$author->id}}')"><em
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
                    <h5 class="modal-title">Register New Authors</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="author-name">Author Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="author-name" placeholder="Eg: John Smith"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="author-position">Position (Optional)</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="author-position"
                                   placeholder="Eg: Managing Director">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="author-company">Company (Optional)</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="author-company"
                                   placeholder="Eg: AdvanceTech Pte. Lte">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" onclick="insert_authors()"
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

        function insert_authors() {
            let author_name = $('#author-name').val();
            let author_position = $('#author-position').val();
            let author_company = $('#author-company').val();

            $.ajax({
                url: '{{route('authors.store')}}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    name: author_name,
                    position: author_position,
                    company: author_company
                },
                success: function () {
                    Swal.fire(
                        'Success!',
                        'Your author has been added.',
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
                text: 'You will delete this author!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, keep it'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('authors.destroy')}}',
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
                        url: '{{route('authors.update')}}',
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
                                'Your authors status been update.',
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
