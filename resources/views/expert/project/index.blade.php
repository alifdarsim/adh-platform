@extends('layouts.user.main')
@section('content')
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Manage Your Projects</h3>
                <div class="nk-block-des text-soft">
                    <p>Total projects:
                        {{ $project_expert->count() }} projects</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                        <em class="icon ni ni-more-v"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary text-white btn-outline-primary"><i
                                    class="fa-solid fa-person me-1"></i>As Expert</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        @if ($project_expert->count() == 0)
            <div class="card py-5 mt-3 tw-items-center tw-flex tw-justify-center">
                <img src="/images/svg/no-data.svg" alt="no-data" class="tw-w-96">
                <h4 class="tw-text-2xl tw-font-semibold tw-mt-5">You don't have any project yet</h4>
                <p class="tw-text-gray-500 tw-mt-2">Any project that you have been invited to will appear here.</p>
            </div>
        @else
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
                                        id="searchbar" placeholder="Search Project, User name">
                                </div>
                            </div>
                        </div>
                        <div class="card-tools me-n1">
                            <ul class="btn-toolbar gx-1">
                                <li>
                                    <div class="toggle-wrap">
                                        <a href="#" class="btn btn-icon btn-trigger toggle"
                                            data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
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
                                                        <div
                                                            class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                            <div class="dropdown-head">
                                                                <span class="sub-title dropdown-title">Filter Table</span>
                                                            </div>
                                                            <div class="dropdown-body dropdown-body-rg">
                                                                <div class="row gx-6 gy-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="overline-title overline-title-alt"
                                                                                for="status">STATUS</label>
                                                                            <select
                                                                                class="form-select js-select2 js-select2-sm"
                                                                                id="status">
                                                                                <option value="all">ONGOING</option>
                                                                                <option value="interested">COMPLETE</option>
                                                                                <option value="pending">SHORLISTED</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="overline-title overline-title-alt">COLUMN
                                                                                SEARCH</label>
                                                                            <br>
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
                                                                <li><a class="export-btn py-2 clickable"
                                                                        val="excel"><span><i
                                                                                class="fa-solid fa-file-excel fs-7 me-1"></i>Export
                                                                            Excel</span></a></li>
                                                                <li><a class="export-btn py-2 clickable"
                                                                        val="pdf"><span><i
                                                                                class="fa-solid fa-file-pdf fs-7 me-1"></i>Export
                                                                            Pdf</span></a></li>
                                                                <li><a class="export-btn py-2 clickable"
                                                                        val="print"><span><i
                                                                                class="fa-solid fa-print fs-7 me-1"></i>Print
                                                                            Table</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .toggle-content -->
                                    </div><!-- .toggle-wrap -->
                                </li><!-- li -->
                            </ul><!-- .btn-toolbar -->
                        </div><!-- .card-tools -->
                    </div><!-- .card-title-group -->
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
                    </div><!-- .card-search -->
                </div><!-- .card-inner -->
                <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col"><span class="sub-text">Project</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Client</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Initiate Date</span></th>
{{--                            <th class="nk-tb-col"><span class="sub-text">Expert Selection</span></th>--}}
                            <th class="nk-tb-col"><span class="sub-text">Accept Invitation?</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    @include('expert.project.modals.contract')
@endsection

@push('scripts')
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>
    <script>
        datatableInit('#datatable', {
            ajax: '{{ route('expert.projects.datatable') }}',
            // order:  [[4, 'desc']],
            columnDefs: [{
                    "orderable": false,
                    "targets": [0, 1, 2, 3]
                },
                {
                    "className": "nk-tb-col",
                    "targets": "_all"
                },
                {
                    "className": "clickable",
                    "targets": [0, 1, 2, 3],
                    "createdCell": function(td, cellData, rowData) {
                        $(td).on('click', () => window.location.href =
                            '{{ route('expert.projects.show', '') }}/' + rowData.pid)
                    }
                }
            ],
            columns: [
                {
                    data: 'project_name',
                    render: function(data, type, row) {
                        return `<div class="user-info">
                                <h6 class="title fs-15px mb-0 tw-text-slate-600">${data}</h6>
                                <span class="sub-text tw-py-0.5">Project ID: ${row.pid}</span>
                                <span class="sub-text">Status: <span class="badge ms-1 tw-capitalize text-white bg-${row.status === 'completed' ? 'success' : (row.status === 'ongoing' ? 'info' : 'warning')}">${row.status}</span></span>
                            </div>`;
                    }
                },
                {
                    data: 'client',
                },
                {
                    data: 'created_at',
                    "render": function(data) {
                        return moment(data).format('DD MMM YYYY');
                    }
                },
                {
                    data: 'accepted',
                    render: function(data) {
                        console.log(data)
                        let color = data === true ? 'success' : (data === false ? 'secondary' : 'danger');
                        let icon =
                            `<em class="text-secondary fs-5 icon ni ni-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You will be notify as soon as the client award this project"></em>`;
                        return `<div class="d-flex"><span class="badge ms-1 rounded-pill text-capitalize bg-${color} px-2">${data === true ? 'Accept' : (data === false ? 'Reject' : 'No Respond')}</span>${data ? icon : ''}</div>`;
                    }
                },
                {
                    data: 'id',
                    render: function(data, type, row) {
                        return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a class="clickable" href="#"><em class="icon ni ni-eye"></em><span>Confirm Payment</span></a></li>
                                                <li><a class="clickable" onclick="setContract('${row.id}')"><em class="icon ni ni-building"></em><span>Set Contract</span></a></li>
                                                <li><a class="clickable" onclick="remove('${row.id}')"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>`
                    },
                },
            ]
        });

        function respond(pid, accept) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You want to ${accept ? 'show interest' : 'reject'} on this project?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: 'No, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('expert.projects.respond') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            pid: pid,
                            respond: accept
                        },
                        success: function(response) {
                            Swal.fire('Success', response.message, 'success');
                            table.ajax.reload();
                        },
                        error: function(error) {
                            Swal.fire('Error', error.responseJSON.message, 'error');
                        }
                    });
                }
            });
        }
    </script>
@endpush
