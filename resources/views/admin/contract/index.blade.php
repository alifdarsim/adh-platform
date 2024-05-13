@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Project Contract List</h3>
                <div class="nk-block-des text-soft">
                    <p>See all contract information of all project.</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
{{--                            <li class="nk-block-tools-opt"><a onclick="saveContract()" class="btn btn-primary"><em class="icon ni ni-save"></em><span>Save Contract</span></a></li>--}}
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
                    <th class="nk-tb-col"><span class="sub-text">Contract ID</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Project</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Expert Name</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Template Language</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Status</span></th>
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
            ajax: '{{ route('admin.contract.index') }}',
            columnDefs: [
                {
                    "orderable": false,
                    "targets": [0, 1, 2, 3]
                },
                {
                    "className": "nk-tb-col",
                    "targets": "_all"
                },
                {
                    "className": "clickable",
                    "targets": [0,1,2,3],
                    "createdCell": function(td, cellData, rowData) {
                        $(td).on('click', () => window.location.href =
                            '{{ route('admin.contract.show', '') }}/' + rowData.contract_id)
                    }
                },
            ],
            pageLength: localStorage.getItem(window.location.pathname + '_pagination') || 10,
            columns: [
                {
                    data: 'contract_id'
                },
                {
                    data: 'project_expert',
                    render: function(data) {
                        return `<div href="{{ route('admin.projects.show', '') }}/${data.pid}" class="text-capitalize">${data.project.name}</a>`; // Link to project
                    }
                },
                {
                    data: 'project_expert',
                    render: function(data) {
                        return `<div class="text-capitalize">${data.expert.name}</a>`; // Link to project
                    }
                },
                {
                    data: 'template',
                    render: function(data) {
                        return getLanguageEmoji(data.language);
                    }
                },
                {
                    data: 'status',
                    render: function(data) {
                        let color = data === 'pending' ? 'warning' : data === 'approved' ? 'info' : data === 'submitted' ? 'success' : 'info';
                        return `<span class="text-capitalize badge bg-${color}">
                                    <i class="fa-solid fa-circle-check fs-7 me-1 my-auto"></i>
                                    ${data === 'approved' ? 'Waiting Expert' : data === 'submitted' ? 'Signed' : data}
                                </span>`;
                    }
                },
                {
                    data: 'contract_id',
                    className: 'nk-tb-col-tools',
                    render: function (data, type, row) {
                        return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a class="clickable" onclick="view('${data}')"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>`
                    },
                },
            ]
        });

        function view(contract_id){
            window.location.href = '{{ route('admin.contract.show', '') }}/' + contract_id;
        }
    </script>
@endpush
