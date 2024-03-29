@php
    $projects = auth()->user()->client->projects;
    $projects = $projects->filter(function ($project) {
        return $project->createdBy->name == auth()->user()->name;
    });
@endphp
@extends('layouts.user.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content"><h3 class="nk-block-title page-title">Project Created By You</h3>
                <div class="nk-block-des text-soft"><p>Manage all projects that you create as a Client</p></div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                       data-target="pageMenu"><em class="icon ni ni-more-v"></em>
                    </a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li><a href="{{route('client.projects.create')}}" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Create New Project</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">

        @if($projects->count() == 0)
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
                                    <div class="form-icon form-icon-left form-control"><i class="fa-regular fa-magnifying-glass"></i></div>
                                    <input type="text" class="tw-w-96 form-control form-control tw-rounded !tw-ps-12 focus:tw-border focus:tw-border-blue-500" id="searchbar" placeholder="Search Project, User name">
                                </div>
                            </div>
                        </div>
                        <div class="card-tools me-n1">
                            <ul class="btn-toolbar gx-1">
                                <li>
                                    <div class="toggle-wrap">
                                        <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-menu-right"></em></a>
                                        <div class="toggle-content" data-content="cardTools">
                                            <ul class="btn-toolbar gx-1">
                                                <li class="toggle-close">
                                                    <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                </li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-filter-alt"></em>
                                                        </a>
                                                        <div class="filter-wg dropdown-menu dropdown-menu-xl dropdown-menu-end">
                                                            <div class="dropdown-head">
                                                                <span class="sub-title dropdown-title">Filter Table</span>
                                                            </div>
                                                            <div class="dropdown-body dropdown-body-rg">
                                                                <div class="row gx-6 gy-3">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="overline-title overline-title-alt" for="status">STATUS</label>
                                                                            <select class="form-select js-select2 js-select2-sm" id="status">
                                                                                <option value="all">All Status</option>
                                                                                <option value="interested">Waiting Selection</option>
                                                                                <option value="not-interested">Not Interested</option>
                                                                                <option value="pending">Pending Respond</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label class="overline-title overline-title-alt">COLUMN SEARCH</label>
                                                                            <br>
                                                                            <div class="custom-control custom-switch mt-1">
                                                                                <input type="checkbox" class="custom-control-input" id="column_search">
                                                                                <label class="custom-control-label" for="column_search">Hide</label>
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
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
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
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
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
                                                        <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                            <em class="icon ni ni-download-cloud"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu dropdown-menu-end">
                                                            <ul class="link-check">
                                                                <li><span>Export As</span></li>
                                                                <li><a class="export-btn py-2 clickable" val="excel"><span><i class="fa-solid fa-file-excel fs-7 me-1"></i>Export Excel</span></a></li>
                                                                <li><a class="export-btn py-2 clickable" val="pdf"><span><i class="fa-solid fa-file-pdf fs-7 me-1"></i>Export Pdf</span></a></li>
                                                                <li><a class="export-btn py-2 clickable" val="print"><span><i class="fa-solid fa-print fs-7 me-1"></i>Print Table</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul><!-- .btn-toolbar -->
                                        </div><!-- .toggle-content -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-search search-wrap" data-search="search">
                        <div class="card-body">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or email">
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
                        <th class="nk-tb-col"><span class="sub-text">Created</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Expert Selection</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Created By</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Company</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end noExport"></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection

@push('scripts')
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>
    <script>
        datatableInit('#datatable', {
            ajax: '{{route('client.projects.datatable')}}',
            order:  [[2, 'desc']],
            columnDefs: [
                { "orderable": false, "targets": [0,1,3,4,5,6,7] },
                { "className": "nk-tb-col", "targets": "_all" },
                {
                    "className": "clickable",
                    "targets": [0,1,2,3,5],
                    "createdCell": function (td, cellData, rowData) {
                        $(td).on('click', () => window.location.href = '{{route('client.projects.show', '')}}/' + rowData.pid )
                    }
                }
            ],
            pageLength: localStorage.getItem(window.location.pathname + '_pagination') || 10,
            columns: [
                {
                    data: 'status',
                    render: function (data) {
                        let color = data === 'pending' ? 'danger' : (data === 'shortlisted' ? 'info' : (data === 'awarded' ? 'success' : 'secondary'));
                        return `<span class="badge ms-1 rounded-pill text-capitalize bg-${color} center">${data === 'shortlisted' ? 'Expert Shortlisting' : data}</span>`;
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
                    "render": function (data) {
                        return moment(data).format('DD MMM YYYY');
                    }
                },
                {
                    data: 'deadline',
                    "render": function (data) {
                        return moment(data).format('DD MMM YYYY');
                    }
                },
                {
                    data: 'created_by'
                },
                {
                    data: 'company',
                    render: function (data, type, row) {
                        return `<img src="${row.company_img}" width="36" height="36" class="round-sm" alt="" data-bs-toggle="tooltip" data-bs-placement="top" title="${data}">`
                    }
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
                                                <li><a class="clickable" href="{{route('client.projects.show',"")}}/${row.pid}"><em class="icon ni ni-eye"></em><span>Show Details</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>`
                    },
                },
            ]
        });

    </script>

@endpush
