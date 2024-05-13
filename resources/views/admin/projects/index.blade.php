@extends('layouts.admin.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Manage Projects</h3>
                <div class="nk-block-des text-soft">
                    <p>Manage AsiaDealHub projects including adding, approving and deleting projects.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="{{ route('admin.companies.create') }}" class="btn btn-primary toggle-expand"
                        data-target="pageMenu"><span>Add Company</span></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a href="{{ route('admin.projects.create') }}"
                                        class="btn btn-white btn-outline-primary"><em
                                            class="icon ni ni-plus"></em><span>Create Project</span></a>
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
            <div class="card-inner position-relative card-tools-toggle py-3">
                <div class="card-title-group">
                    <div class="card-tools">
                        <div class="form-inline flex-nowrap gx-3">
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left form-control"><i
                                        class="fa-regular fa-magnifying-glass"></i></div>
                                <input type="text"
                                    class="tw-w-96 form-control form-control tw-rounded !tw-ps-12 focus:tw-border focus:tw-border-blue-500"
                                    id="searchbar" placeholder="Search Project Name">
                            </div>
                        </div>
                    </div>
                    <div class="card-tools me-n1">
                        <ul class="btn-toolbar gx-1">
                            <li>
                                <div class="toggle-wrap">
                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em
                                            class="icon ni ni-menu-right"></em></a>
                                    <div class="toggle-content" data-content="cardTools">
                                        <ul class="btn-toolbar gx-1">
                                            <li class="toggle-close">
                                                <a href="#" class="btn btn-icon btn-trigger toggle"
                                                    data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                            </li>
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-filter-alt"></em>
                                                    </a>
                                                    <div class="filter-wg dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                        <div class="dropdown-head">
                                                            <span class="sub-title dropdown-title">Column Search</span>
                                                        </div>
                                                        <div class="dropdown-body dropdown-body-rg">
                                                            <div class="row gx-6 gy-3">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="custom-control custom-switch mt-1">
                                                                            <input type="checkbox"
                                                                                class="custom-control-input"
                                                                                id="column_search">
                                                                            <label class="custom-control-label"
                                                                                for="column_search">Hide</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-eye"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu dropdown-menu-end">
                                                        <ul class="link-check">
                                                            <li><span>Show/Hide Column</span></li>
                                                            <div id="colvis-holder">
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-setting"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                        <ul class="link-check">
                                                            <li><span>Row Per Page</span></li>
                                                            <li><a class="page-btn py-2 clickable">6</a></li>
                                                            <li><a class="page-btn py-2 clickable">10</a></li>
                                                            <li><a class="page-btn py-2 clickable">20</a></li>
                                                            <li><a class="page-btn py-2 clickable">50</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-download-cloud"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu dropdown-menu-end">
                                                        <ul class="link-check">
                                                            <li><span>Export As</span></li>
                                                            <li><a class="export-btn py-2 clickable" val="excel"><span><i
                                                                            class="fa-solid fa-file-excel fs-7 me-1"></i>Export
                                                                        Excel</span></a></li>
                                                            <li><a class="export-btn py-2 clickable" val="pdf"><span><i
                                                                            class="fa-solid fa-file-pdf fs-7 me-1"></i>Export
                                                                        Pdf</span></a></li>
                                                            <li><a class="export-btn py-2 clickable" val="print"><span><i
                                                                            class="fa-solid fa-print fs-7 me-1"></i>Print
                                                                        Table</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!-- .toggle-content -->
                                </div><!-- .toggle-wrap -->
                            </li><!-- li -->
                        </ul>
                    </div>
                </div>
                <div class="card-search search-wrap" data-search="search">
                    <div class="card-body">
                        <div class="search-content">
                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em
                                    class="icon ni ni-arrow-left"></em></a>
                            <input type="text" class="form-control border-transparent form-focus-none"
                                placeholder="Search by user or email">
                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                        </div>
                    </div>
                </div>
            </div>
            <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Hub</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Initiated</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Created By</span></th>
                        <th class="nk-tb-col"><span class="sub-text">ADH PIC</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Company</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end noExport"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>
    <script>
        datatableInit('#datatable', {
            ajax: '{{ route('admin.projects.datatable') }}',
            order: [
                [3, 'desc']
            ],
            columnDefs: [{
                    "orderable": false,
                    "targets": [0, 1, 2, 4, 5, 6, 7]
                },
                {
                    "className": "nk-tb-col",
                    "targets": "_all"
                },
                {
                    "className": "clickable",
                    "targets": [0, 1, 2, 3, 5],
                    "createdCell": function(td, cellData, rowData) {
                        $(td).on('click', () => window.location.href =
                            '{{ route('admin.projects.show', '') }}/' + rowData.pid)
                    }
                },
                {
                    "targets": [1],
                    width: '35%'
                }
            ],
            pageLength: localStorage.getItem(window.location.pathname + '_pagination') || 10,
            columns: [{
                    data: 'status',
                    render: function(data) {
                        let color = data === 'pending' ? 'danger' : (data === 'ongoing' ? 'info' : (data === 'closed' ? 'dark' : 'secondary'));
                        return `<span class="badge ms-1 rounded-pill text-capitalize bg-${color}">${data === 'active' ? 'Shortlisting' : data}</span>`;
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'hub',
                },
                {
                    data: 'created_at',
                    "render": function(data) {
                        return moment(data).format('DD MMM YYYY');
                    }
                },
                {
                    data: 'created_by'
                },
                {
                    data: 'handle_by',
                    "render": function(data) {
                        return data ? data : "-";
                    }
                },
                {
                    data: 'company',
                    render: function(data, type, row) {
                        return `<img src="${row.company_img}" width="36" height="36" class="round-sm" alt="" data-bs-toggle="tooltip" data-bs-placement="top" title="${data}">`
                    }
                },

                {
                    data: 'id',
                    className: 'nk-tb-col-tools',
                    render: function(data, type, row) {
                        console.log(row)
                        return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a class="clickable" href="{{ route('admin.projects.show', '') }}/${row.pid}"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                <li><a class="clickable" onclick="edit('${row.pid}')"><em class="icon ni ni-pen "></em><span>Edit</span></a></li>
                                                <li><a class="clickable ${row.status === 'pending' ? '' : 'disabled'}" onclick="approve('${row.pid}')"><em class="icon ni ni-check "></em><span>Approve</span></a></li>
                                                <li><a class="clickable" onclick="remove('${row.pid}')"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                                <li><a class="clickable" onclick="reset('${row.pid}')"><em class="icon ni ni-reload"></em><span>Reset Project</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>`
                    },
                },
            ]
        });

        function approve(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to approve this project!. This process is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D94148',
                cancelButtonColor: '#6E768F',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.projects.respond', '') }}/" + id,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            Swal.fire(
                                'Approved!',
                                'Project has been approved.',
                                'success'
                            ).then((result) => {
                                table.ajax.reload();
                            })
                        },
                        error: function(data) {
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

        function remove(pid) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to remove this projects from database!. This process is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D94148',
                cancelButtonColor: '#6E768F',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.projects.destroy', '') }}/" + pid,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                'Company has been removed from database.',
                                'success'
                            ).then((result) => {
                                table.ajax.reload();
                            })
                        },
                        error: function(data) {
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

        function reset(pid) {
            Swal.fire({
                title: 'Reset Project?',
                text: "This will reset the project to pending status. This process is irreversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D94148',
                cancelButtonColor: '#6E768F',
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.projects.reset', '') }}/" + pid,
                        type: 'PUT',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            Swal.fire(
                                'Reset!',
                                'Project has been reset.',
                                'success'
                            ).then((result) => {
                                table.ajax.reload();
                            })
                        },
                        error: function(data) {
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

        function edit(pid) {
            window.location.href = "{{ route('admin.projects.edit', ':id') }}".replace(':id', pid);
        }
    </script>
@endpush
