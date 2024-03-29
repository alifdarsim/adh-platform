@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Companies List</h3>
                <div class="nk-block-des text-soft">
                    <p>Found a total of {{$count}} companies register inside database.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="{{route('admin.companies.create')}}" class="btn btn-primary toggle-expand" data-target="pageMenu"><span>Add Company</span></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt"><a href="{{route('admin.companies.create')}}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add Company</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="form-control-wrap">
            <div class="form-icon form-icon-left form-control-lg"><i class="fa-regular fa-magnifying-glass ms-2"></i></div>
            <input type="text" class="form-control form-control-lg tw-rounded-full ps-5 focus:tw-border focus:tw-border-blue-500" id="searchbar" placeholder="Search Company Name">
        </div>
        <div class="card mt-3 card-bordered card-preview">
            <div class="card-inner">

                <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Image</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Type</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Industry</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Country</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Created At</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function remove(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This process is irreversible, all data such as projects, users, etc. related to this companies will be deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D94148',
                cancelButtonColor: '#6E768F',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('admin.companies.destroy', '')}}/" + id,
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
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
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

        $('#searchbar').on('keyup', function () {
            $('#datatable').DataTable().search($(this).val()).draw();
        });

        $(function () {
            let has_export = true;
            let btn = has_export ? '<"dt-export-buttons d-flex align-center"<"dt-export-title d-none d-md-inline-block">B>' : '',
                btn_cls = has_export ? ' with-export' : '';
            let dom = '<"row justify-between g-2' + btn_cls + '"<"col-7 col-sm-4 text-start"><"col-5 col-sm-8 text-end"<"datatable-filter"<"d-flex justify-content-end g-2"' + btn + '>>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-start text-md-end"i>>';

            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                bdestroy: true,
                autoWidth: false,
                dom: dom,
                ajax: "{{ route('admin.companies.datatable') }}",
                buttons: ['copy', 'excel', 'csv', 'pdf'],
                columns: [
                    {
                        data: 'img_url',
                        className: 'nk-tb-col',
                        render: function (data, type, row) {
                            return `<div><img class="tw-w-10 round-lg" src="${data}" alt=""></div>`
                        }
                    },
                    {
                        data: 'name',
                        className: 'nk-tb-col tw-cursor-pointer hover:tw-text-blue-500 hover:tw-bg-slate-100',
                        render: function (data, type, row) {
                            return `<span>${data}</span>`
                        }
                    },
                    {
                        data: 'type',
                        className: 'nk-tb-col',
                        render: function (data, type, row) {
                            return `<span>${data}</span>`
                        }
                    },
                    {
                        data: 'industry',
                        className: 'nk-tb-col',
                        render: function (data, type, row) {
                            return `<span>${data}</span>`
                        }
                    },
                    {
                        data: 'country',
                        className: 'nk-tb-col',
                        render: function (data, type, row) {
                            return `<span>${row.address.emoji ?? ''} ${data}</span>`
                        }
                    },
                    {
                        data: 'created_at',
                        className: 'nk-tb-col',
                        render: function (data, type, row) {
                            return `<span>${data}</span>`
                        }
                    },
                    {
                        data: 'id',
                        className: 'nk-tb-col nk-tb-col-tools',
                        render: function (data, type, row) {
                            return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a class="clickable" href="{{route('admin.companies.show', '')}}/${data}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                {{--<li><a class="clickable" href="{{route('admin.companies.edit', '')}}/${data}"><em class="icon ni ni-edit"></em><span>Edit Details</span></a></li>--}}
                                                <li><a class="clickable" onclick="remove(${data})"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>`
                        },
                        order: [[2, 'asc']],
                    },
                ],
                order: [[3, 'desc']],
                createdRow: function (row) {
                    $(row).addClass('nk-tb-item');
                },
                language: {
                    search: "",
                    searchPlaceholder: "Type in to Search",
                    lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                    info: "_START_ -_END_ of _TOTAL_",
                    infoEmpty: "0",
                    infoFiltered: "( Total _MAX_  )",
                }
            });

            table.on('click', 'tbody .custom-control-input', function (e) {
                let row = $(this).closest('tr');
                console.log(row)
                row[0].classList.toggle('nk-tb-item-selected');
            });

            //trigger a function after table draw
            {{--table.on('draw', function () {--}}
            {{--    $('.open_project').click(e => {--}}
            {{--        let pid = $(e)[0].currentTarget.children[1].innerText;--}}
            {{--        window.location.href = "{{route('expert.manage.project.show', '')}}/" + pid;--}}
            {{--    })--}}
            {{--});--}}

        });
    </script>
@endpush
