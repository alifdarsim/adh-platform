@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Import Experts Queue</h3>
                <div class="nk-block-des text-soft">
                    <p>Import expert database from LinkedIn into AsiaDealHub expert database</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="{{route('admin.companies.create')}}" class="btn btn-primary toggle-expand" data-target="pageMenu"><span>Add Company</span></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a onclick="bulk_processing()" class="btn btn-white btn-outline-primary"><i class="fa-regular fa-arrows-rotate fs-6 me-2"></i><span>Bulk Scraping</span></a>
                                    <a onclick="create()" class="btn btn-white btn-primary"><em class="icon ni ni-plus"></em><span>Import LinkedIn URL</span></a>
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
                                                                            <option value="0">Pending</option>
                                                                            <option value="1">Scrape</option>
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
                                        </ul>
                                    </div>
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
                    <th class="nk-tb-col"><span class="sub-text">LinkedIn Url</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Status</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Last Scrape</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Processed</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Last Process</span></th>
{{--                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>--}}
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
            ajax: '{{route('admin.expert_scrape.datatable')}}',
            order: [[2, 'asc'], [1, 'asc']],
            columnDefs: [
                { "className": "nk-tb-col", "targets": "_all" }
            ],
            columns: [
                {
                    data: 'url'
                },
                {
                    data: 'status',
                    render: function (data, type, row) {
                        let color = data === 1 ? 'success' : 'danger'
                        let html = `<span class="badge text-capitalize bg-${color}">${data === 1 ? 'Scraped' : 'Pending'}</span>`;
                        if (data !== 1) html += `<a class="ms-1 btn btn-sm btn-primary" onclick="scrape(${row.id})"><i class="fa-solid fa-arrows-rotate"></i></a>`;
                        else html += `<a class="ms-1 btn btn-sm btn-secondary" onclick="scrape(${row.id})"><i class="fa-solid fa-arrows-rotate"></i></a>`;
                        return html;
                    }
                },
                {
                    data: 'last_scrape',
                    render: function (data) {
                        return data ? moment(data).format('DD MMM YYYY') : 'N/A';
                    }
                },
                {
                    data: 'processed',
                    render: function (data, type, row) {
                        let color = data === 1 ? 'success' : 'danger'
                        let html = `<span class="badge text-capitalize bg-${color}">${data === 1 ? 'Processed' : 'Pending'}</span>`;
                        if (data !== 1) html += `<a class="ms-1 btn btn-sm btn-primary" onclick="processed(${row.id})"><i class="fa-regular fa-arrows-rotate"></i></a>`;
                        else html += `<a class="ms-1 btn btn-sm btn-secondary" onclick="processed(${row.id})"><i class="fa-regular fa-arrows-rotate"></i></a>`;
                        return html;
                    }
                },
                {
                    data: 'last_process',
                    render: function (data) {
                        return data ? moment(data).format('DD MMM YYYY') : 'N/A';
                    }
                },
            ]
        });

        function scrape(id) {
            _Swal.loading('Scraping profile', 'Please wait...');
            // set timeout to simulate the request
            $.ajax({
                url: `{{route('admin.expert_scrape.scrape','')}}/${id}`,
                type: 'GET',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (res) {
                    Swal.close();
                    Swal.fire({
                        title: 'Success!',
                        text: res.message,
                        icon: 'success'
                    }).then((result) => {
                        table.ajax.reload();
                    })
                },
                error: function (res) {
                    Swal.fire({
                        title: 'Error!',
                        text: res.responseJSON.message,
                        icon: 'error'
                    })
                }
            })
        }

        function create(){
            Swal.fire({
                title: 'Enter LinkedIn Url',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Add to queue',
                showLoaderOnConfirm: true,
                preConfirm: (url) => {
                    return $.ajax({
                        url: "{{route('admin.expert_scrape.store')}}",
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            url: url,
                        },
                        success: function (data) {
                            Swal.fire('Success!', data.message, 'success').then(() => table.ajax.reload())
                        },
                        error: function (data) {
                            Swal.fire('Error!', data.responseJSON.message, 'error')
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Success!',
                        text: result.value.message,
                        icon: 'success'
                    }).then((result) => {
                        table.ajax.reload();
                    })
                }
            })
        }

        function processed(id) {
            _Swal.loading('Processing profile', 'Please wait...');
            $.ajax({
                url: `{{route('admin.expert_scrape.processed','')}}/${id}`,
                type: 'GET',
                data: {
                    _token: '{{csrf_token()}}'
                },
                success: function (res) {
                    Swal.close();
                    table.ajax.reload();
                },
                error: function (res) {
                    Swal.fire({
                        title: 'Error!',
                        text: res.responseJSON.message,
                        icon: 'error'
                    })
                }
            })
        }

        function bulk_processing(){

            Swal.fire({
                title: 'Bulk Scraping and Process?',
                html: `This may take a while depends on the number of profiles to scrape and process<br><br>You may leave this page and come back later to check the status.`,
                showCancelButton: true,
                confirmButtonText: 'Scrape',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    _Swal.loading('Bulk Scraping', 'Please wait...');
                    // wait 2000ms for the request to complete
                    setTimeout(() => {
                        _Swal.error('API Limit reached, please upgrade RapidAPI LinkedIn scraping plan.', 'API Limit')
                    }, 1000)
                    {{--let urls = $('#urls').val();--}}
                    {{--if(urls === ''){--}}
                    {{--    Swal.showValidationMessage(`Please enter LinkedIn Urls`)--}}
                    {{--}else{--}}
                    {{--    return $.ajax({--}}
                    {{--        --}}{{--url: "{{route('admin.expert_scrape.bulk_scrape')}}",--}}
                    {{--        type: 'POST',--}}
                    {{--        data: {--}}
                    {{--            _token: "{{csrf_token()}}",--}}
                    {{--            urls: urls--}}
                    {{--        },--}}
                    {{--        success: function (data) {--}}
                    {{--            Swal.fire(--}}
                    {{--                'Scraped!',--}}
                    {{--                'Profiles has been scraped.',--}}
                    {{--                'success'--}}
                    {{--            ).then((result) => {--}}
                    {{--                table.ajax.reload();--}}
                    {{--            })--}}
                    {{--        },--}}
                    {{--        error: function (data) {--}}
                    {{--            Swal.fire(--}}
                    {{--                'Error!',--}}
                    {{--                'Something went wrong.',--}}
                    {{--                'error'--}}
                    {{--            )--}}
                    {{--        }--}}
                    {{--    });--}}
                    {{--}--}}
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }
    </script>
@endpush
