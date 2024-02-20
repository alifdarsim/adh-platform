@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Industry Classification</h3>
                <div class="nk-block-des text-soft">
                    <p>Add, edit, delete and manage industry classification for Expert Dashboard.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a onclick="create()" class="btn btn-white btn-primary"><em class="icon ni ni-plus"></em><span>Create Industry Classification</span></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist " data-auto-responsive="true">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col"><span class="sub-text">ID</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Main Industry</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Sub Industry</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end noExport">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>
    <script>
        datatableInit('#datatable', {
            ajax: '{{route('admin.industry_classification.datatable')}}',
            simpleTable: true,
            order: [0, 'desc'],
            columnDefs: [
                { "className": "nk-tb-col py-2", "targets": "_all" },
            ],
            pageLength: 20,
            columns: [
                {
                    data: 'id'
                },
                {
                    data: 'main',
                },
                {
                    data: 'sub',
                },
                {
                    data: 'id',
                    className: 'nk-tb-col-tools',
                    render: function (data, type, row) {
                        return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a class="clickable" onclick="remove(${data})"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>`
                    },
                },
            ]
        });

        function edit(id, name, status) {
            Swal.fire({
                title: 'Edit Hub',
                html: `<div class="form-group mb-1 my-2"><label class="form-label" for="name">Input text Default</label><div class="form-control-wrap"><input type="text" class="form-control" value="${name}" id="name" placeholder="Input Hub Name"></div></div>
                       <div class="form-group"><label class="form-label">Select Status</label><div class="form-control-wrap"><select class="form-select js-select2" id="status"><option value="show">Show</option><option value="hide">Hide</option></select></div></div>
                       `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    let name = $('#name').val();
                    let status = $('#status').val();
                    if(name === ''){
                        Swal.showValidationMessage(
                            `Please enter hub name`
                        )
                    }else{
                        return $.ajax({
                            url: "{{route('admin.industry_classification.update', '')}}/" + id,
                            type: 'PUT',
                            data: {
                                _token: "{{csrf_token()}}",
                                name: name,
                                status: status,
                            },
                            success: function (data) {
                                Swal.fire(
                                    'Updated!',
                                    'Hub has been updated.',
                                    'success'
                                ).then((result) => {
                                    table.ajax.reload();
                                })
                            },
                            error: function (data) {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                )
                            }
                        });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

        function remove(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to remove industry classification from database?. This process is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D94148',
                cancelButtonColor: '#6E768F',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('admin.industry_classification.destroy', '')}}/" + id,
                        type: 'DELETE',
                        data: {
                            _token: "{{csrf_token()}}",
                        },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Company has been removed from database.',
                                'success'
                            ).then((result) => {
                                table.ajax.reload();
                            })
                        },
                        error: function (data) {
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

        function create(){
            Swal.fire({
                title: 'Create Industry Classification',
                html: `<div class="mt-3"><label for="main">Main Industry Classification</label><input type="text" id="main" class="swal2-input" placeholder="Hub Name"><br><label for="sub">Sub Industry Classification</label><input type="text" id="sub" class="swal2-input" placeholder="Hub Name"></div>`,
                showCancelButton: true,
                confirmButtonText: 'Create',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    let main = $('#main').val();
                    let sub = $('#sub').val();
                    if(main === '' && sub === ''){
                        Swal.showValidationMessage(`Please enter hub name`)
                    }else{
                        return $.ajax({
                            url: "{{route('admin.industry_classification.store')}}",
                            type: 'POST',
                            data: {
                                _token: "{{csrf_token()}}",
                                main: main,
                                sub: sub
                            },
                            success: function (data) {
                                Swal.fire(
                                    'Created!',
                                    'Hub has been created.',
                                    'success'
                                ).then((result) => {
                                    table.ajax.reload();
                                })
                            },
                            error: function (data) {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                )
                            }
                        });
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }
    </script>
@endpush
