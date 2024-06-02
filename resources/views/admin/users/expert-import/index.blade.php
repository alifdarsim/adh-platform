@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Imported LinkedIn Expert List</h3>
                <div class="nk-block-des text-soft">
                    <p>List of all experts scraped from LinkedIn</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="{{route('admin.companies.create')}}" class="btn btn-primary toggle-expand" data-target="pageMenu"><span>Add Company</span></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a onclick="import_expert()" class="btn btn-white btn-outline-primary"><em class="icon ni ni-plus"></em><span>Import LinkedIn Expert</span></a>
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
                                                    <div class="filter-wg dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                        <div class="dropdown-head">
                                                            <span class="sub-title dropdown-title">Column Filter</span>
                                                        </div>
                                                        <div class="dropdown-body dropdown-body-rg">
                                                            <div class="row gx-6 gy-3">
                                                                <div class="col-12">
                                                                    <div class="form-group">
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
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">LinkedIn URL</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Result</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Addtional Info</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end noExport">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="modal_industry" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Set Industry Classification to Expert</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body modal-body-sm">
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="user-card">
                                <div class="user-avatar bg-dim-primary d-none d-sm-flex"><span><img id="expert_avatar" src="" alt=""></span></div>
                                <div class="user-info">
                                    <span id="expert_name" class="tb-lead fs-16px tw-text-slate-700 tw-font-bold"></span>
                                    <div><i class="fa-brands text-info fa-linkedin fs-6 me-1"></i><span id="expert_linkedin"></span></div>
                                    <input id="expert_id" class="tw-hidden" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 tw-font-bold">
                            Current Industry Classification:
                            <div class="tw-font-bold">Main: <span id="main_text" class="tw-font-normal"></span></div>
                            <div class="tw-font-bold">Sub: <span id="sub_text" class="tw-font-normal"></span></div>
                        </div>
                        <div class="col-sm-6 mt-1">

                            <div class="form-group">
                                <label class="form-label" for="main-industry">Main Industry Classification</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2 select2-hidden-accessible" id="main-industry">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <div class="form-group">
                                <label class="form-label" for="sub-industry">Sub Industry Classification</label>
                                <div class="form-control-wrap">
                                    <select class="form-select js-select2 select2-hidden-accessible" id="sub-industry">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                <li>
                                    <button onclick="updateIndustry()" class="btn btn-primary">Update Industry Classification</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>
    <script>
        datatableInit('#datatable', {
            ajax: '{{route('admin.expert-import.index')}}',
            order:  false,
            stateSave : true,
            columnDefs: [
                { "className": "nk-tb-col", "targets": "_all" },
            ],
            columns: [
                {
                    data: 'linkedin_url',
                    render: function (data, type, row) {
                        let status = row.status;
                        let last_scrape = row.last_scraped_at;
                        return `<div><i class="fa-brands text-info fa-linkedin fs-14px me-1"></i>
                            <a class="text-info" href="${data}" target="_blank">${data.replace('https://www.linkedin.com/in','')}</a></div>
                            <div>Last Scrape: ${last_scrape ? moment(last_scrape).format('DD/MM/YYYY HH:mm A') : 'N/A'}</div>
                            <div>Status: <span class="badge bg-${status === 'pending' ? 'warning' : 'success'} tw-capitalize">${status}</span></div>`
                    }
                },
                {
                    data: 'result',
                    render: function (data, type, row) {
                        console.log(data)
                        if (data === null) return 'N/A';
                        let image = row.profile_image ? `<img class="!tw-rounded-lg" src="${row.profile_image}" class="avatar avatar-sm" alt="">` : '';
                        return `<div class="user-card">
                            <div class="tw-relative user-avatar !tw-w-[54px] !tw-h-[54px] bg-dim-primary d-none d-sm-flex">
                                <span>${image}</span>
                                <span class="${row.verified ? '' : 'd-none'} tw-absolute tw-top-[-12px] tw-left-[-12px]">
                                    <i class="text-info tw-text-xl fa-duotone fa-badge-check" style="--fa-primary-color: #ffffff; --fa-secondary-color: #2976ff; --fa-secondary-opacity: 1;"></i>
                                </span>
                            </div>
                            <div class="user-info">
                                <span class="fs-14px">${data.data.fullName}</span>
                                <div><i class="fa-solid text-info fa-briefcase fs-7 me-1 tw-w-3"></i><span>${data.data.experiences[0].breakdown ? data.data.experiences[0].subComponents[0].title : data.data.experiences[0].title}</span></div>
                                <div><i class="fa-solid text-info fa-building fs-7 me-1 tw-w-3"></i><span>${data.data.experiences[0].breakdown ? data.data.experiences[0].title : (data.data.experiences[0].subtitle).split(' · ')[0]}</span></div>
                                <div><i class="fa-solid text-info fa-flag fs-7 me-1 tw-w-3"></i><span>${data.data.addressCountryOnly != '' ? data.data.addressCountryOnly : data.data.addressWithCountry}</span></div>
                            </div>
                        </div>`;
                    }
                },
                {
                    data: 'email',
                    render: function (data, type, row) {
                        return `<div><i class="fa-solid text-info fa-user-helmet-safety fs-7 me-1 tw-w-3"></i>${row.industry_classification ?? 'No Industry set'}</div>
                            <div><i class="fa-solid text-info fa-envelope fs-7 me-1 tw-w-3"></i>${data ?? 'No email set'}</div>`;
                    }
                },
                {
                    data: 'id',
                    className: 'nk-tb-col-tools',
                    render: function (data, type, row) {
                        console.log(row.result)
                        return `<ul class="nk-tb-actions gx-1">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a class="clickable" onclick="expert_view(${data})"><em class="icon ni ni-eye "></em><span>View Details</span></a></li>
                                            <li><a class="clickable" onclick="re_scrape(${data})"><em class="icon ni ni-globe "></em><span>Re-Scrape</span></a></li>
                                            <li><a class="clickable" onclick="setEmail(${data})"><em class="icon ni ni-mail "></em><span>Set Email</span></a></li>
                                            <li><a class="clickable" onclick="setIndustry('${row.result.data.fullName}', '${row.profile_image}', '${row.linkedin_url}', ${data}, '${row.industry_main}' , '${row.industry_sub}')"><em class="icon ni ni-setting "></em><span>Set Industry Classification</span></a></li>
                                            <li><a class="clickable" onclick="destroy(${data})"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>`
                    },
                },
            ]
        });

        function setIndustry(name, profile_image, linkedin, id, main, sub){
            console.log(main, sub)
            $('#modal_industry').modal('show');

            $('#expert_name').text(name);
            $('#expert_linkedin').text(linkedin);
            $('#expert_id').val(id);
            $('#expert_avatar').attr('src', profile_image);

            $('#main_text').text(main === 'null' ? 'No Industry set yet' : main);
            $('#sub_text').text(sub === 'null' ? 'No Industry set yet' : sub);
        }

        function setEmail(id){
            Swal.fire({
                title: 'Enter Email',
                input: 'email',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Set Email',
                showLoaderOnConfirm: true,
                preConfirm: (email) => {
                    return $.ajax({
                        url: `{{route('admin.expert-import.set-email',':id')}}`.replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            id: id,
                            email: email
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
            })
        }

        function import_expert(){
            Swal.fire({
                title: 'Enter LinkedIn Url',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Add to queue',
                showLoaderOnConfirm: true,
                preConfirm: (linkedin_url) => {
                    return $.ajax({
                        url: "{{route('admin.expert-import.store')}}",
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            linkedin_url: linkedin_url,
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

        function destroy(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: `{{route('admin.expert-import.destroy', ':id')}}`.replace(':id', id),
                        type: 'DELETE',
                        data: {
                            _token: "{{csrf_token()}}"
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
            })
        }

        function re_scrape(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "This will use RapidAPI quota. Continue?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, re-scrape it!',
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: `{{route('admin.expert-import.re-scrape', ':id')}}`.replace(':id', id),
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}"
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
            })
        }

        $( document ).ready(function() {
            $.ajax({
                url: '{{route('industries_expert.main')}}',
                method: 'GET',
                success: function (response) {
                    response.forEach(function (industry) {
                        $('#main-industry').append('<option value="'+industry+'">'+industry+'</option>');
                    });
                }
            });
        });

        let sub_industry_classification;
        $('#main-industry').on('change', function () {
            let main = $(this).val();
            if (main === null) return;
            main = main.replaceAll('/', '_');
            $.ajax({
                url: '{{route('industries_expert.sub','')}}/'+main,
                method: 'GET',
                success: function (response) {
                    $('#sub-industry').empty();
                    response.forEach(function (industry) {
                        $('#sub-industry').append('<option value="'+industry.sub+'">'+industry.sub+'</option>');
                    });
                    if (sub_industry_classification) {
                        $('#sub-industry').val(sub_industry_classification).trigger('change');
                    }
                }
            });
        });

        function updateIndustry(){
            let main = $('#main-industry').val();
            let sub = $('#sub-industry').val();
            let id = $('#expert_id').val();
            $.ajax({
                url: '{{route('admin.expert-import.set-industry', ':id')}}'.replace(':id', id),
                method: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    main: main,
                    sub: sub
                },
                success: function (response) {
                    Swal.fire('Success!', response.message, 'success').then(() => {
                        $('#modal_industry').modal('hide');
                        table.ajax.reload();
                    })
                },
                error: function (response) {
                    Swal.fire('Error!', response.responseJSON.message, 'error')
                }
            });
        }

        function expert_view(id){
            // open in same tab
            window.location.href = `{{route('admin.expert-portal.view-from-import',':id')}}`.replace(':id', id);
        }
    </script>
@endpush
