@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Expert List</h3>
                <div class="nk-block-des text-soft">
                    <p>List of all experts</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="{{route('admin.companies.create')}}" class="btn btn-primary toggle-expand" data-target="pageMenu"><span>Add Company</span></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li class="nk-block-tools-opt">
                                <div class="drodown">
                                    <a href="{{route('admin.expert_scrape.index')}}" class="btn btn-white btn-outline-primary"><em class="icon ni ni-plus"></em><span>Go to Scrape Page</span></a>
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
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Name</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Industry Classification</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Email & Phone</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Position</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Company</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Address</span></th>
                    <th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end noExport"></th>
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
                                    <input id="expert_id" class="tw-hidden" value=""></input>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-4">
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
            ajax: '{{route('admin.experts.datatable')}}',
            order:  false,
            stateSave : true,
            columnDefs: [
                { "orderable": false, "targets": [0,1,2, 3,4] },
                { "className": "nk-tb-col", "targets": "_all" },
                {
                    "className": "clickable",
                    width: "20%",
                    "targets": [0],
                    "createdCell": function (td, cellData, rowData) {
                        console.log(rowData)
                        $(td).on('click', () => window.location.href = `{{route('admin.expert-portal.index','')}}/${rowData.id}`);
                    }
                }
            ],
            columns: [
                {
                    data: 'name',
                    render: function (data, type, row) {
                        return `<div class="user-card">
                            <div class="user-avatar bg-dim-primary d-flex position-relative !tw-w-12 !tw-h-12 !tw-rounded-lg !tw-bg-slate-300">
                                <span>${row.img_url ? `<img class="!tw-rounded-lg" src="${row.img_url}" alt="">` : `<img class="!tw-rounded-lg p-2" src="/images/svg/avatar.svg" alt="">`}
                                ${row.registered ? `<i class="fa-solid fa-badge-check fs-20px text-warning position-absolute tw-top-0 translate-middle"></i>` : ''}
                                </span>
                            </div>
                            <div class="user-info">
                                <span class="tb-lead">${data}</span>
                                <span><i class="fa-brands tw-text-blue-500 fa-linkedin fs-12px tw-me-0.5"></i>${row.url.replace('https://www.linkedin.com/in/','')}</span>
                            </div>
                        </div>`;
                    }
                },
                {
                    data: 'industry_classification',
                    render: function (data, type, row) {
                        return data === 'Not Set' ? '<span class="text-danger"><i class="fa-solid fa-xmark text-danger me-1"></i></span>' : '<span class="fs-13px">'+data+'</span>';
                    }
                },
                {
                    data: '_email',
                    render: function (data, type, row) {
                        let email = `<div class="d-flex tw-items-center fs-13px"><i class="fa-solid fs-11px me-1 fa-envelope"></i>${data === 'Not Set' ? '<i class="fa-solid fa-xmark text-danger me-1"></i>' : data}</div>`;
                        let phone = `<div class="d-flex tw-items-center fs-13px"><i class="fa-solid fs-11px me-1 fa-phone"></i>${row._phone === 'Not Set' ? '<i class="fa-solid fa-xmark text-danger me-1"></i>' : row._phone}</div>`;
                        return email + phone;
                    }
                },
                {
                    data: 'experiences',
                    render: function (data, type, row) {
                        return data[0].position;
                    }
                },
                {
                    data: 'experiences',
                    render: function (data, type, row) {
                        return `<span class="fs-13px">${data[0].company}</span>`;
                    }
                },
                {
                    data: 'address'
                },
                {
                    data: 'country'
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
                                                <li><a class="clickable" onclick="setIndustry('${row.name}', '${row.img_url}', '${row.url.replace('https://www.linkedin.com/in/','')}', '${row.main_industry}', '${row.sub_industry}', ${row.id})"><em class="icon ni ni-building-fill"></em><span>Set Industry Classification</span></a></li>
                                                <li><a class="clickable" onclick="setEmail(${data}, '${row.email}')"><em class="icon ni ni-mail"></em><span>Set Email</span></a></li>
                                                <li><a class="clickable" onclick="setPhone(${data}, '${row.phone}')"><em class="icon ni ni-call"></em><span>Set Phone</span></a></li>
<!--                                                <li><a class="clickable" onclick="re_scrape(${data})"><em class="icon ni ni-globe "></em><span>Re-Scrape</span></a></li>-->
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

        function scrape(id) {
            _Swal.loading('Scraping profile', 'Please wait...');
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

        {{--function create(){--}}
        {{--    Swal.fire({--}}
        {{--        title: 'Enter LinkedIn Url',--}}
        {{--        input: 'text',--}}
        {{--        inputAttributes: {--}}
        {{--            autocapitalize: 'off'--}}
        {{--        },--}}
        {{--        showCancelButton: true,--}}
        {{--        confirmButtonText: 'Add to queue',--}}
        {{--        showLoaderOnConfirm: true,--}}
        {{--        preConfirm: (url) => {--}}
        {{--            return $.ajax({--}}
        {{--                url: "{{route('admin.expert_scrape.store')}}",--}}
        {{--                type: 'POST',--}}
        {{--                data: {--}}
        {{--                    _token: "{{csrf_token()}}",--}}
        {{--                    url: url,--}}
        {{--                },--}}
        {{--                success: function (data) {--}}
        {{--                    Swal.fire('Success!', data.message, 'success').then(() => table.ajax.reload())--}}
        {{--                },--}}
        {{--                error: function (data) {--}}
        {{--                    Swal.fire('Error!', data.responseJSON.message, 'error')--}}
        {{--                }--}}
        {{--            });--}}
        {{--        },--}}
        {{--        allowOutsideClick: () => !Swal.isLoading()--}}
        {{--    }).then((result) => {--}}
        {{--        if (result.isConfirmed) {--}}
        {{--            Swal.fire({--}}
        {{--                title: 'Success!',--}}
        {{--                text: result.value.message,--}}
        {{--                icon: 'success'--}}
        {{--            }).then((result) => {--}}
        {{--                table.ajax.reload();--}}
        {{--            })--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}

        function setIndustry(expert_name, expert_avatar, expert_linkedin, main_industry, sub_industry, expert_id){
            $('#expert_id').val(expert_id)
            $('#expert_name').text(expert_name)
            $('#expert_avatar').attr('src', expert_avatar)
            $('#expert_linkedin').text(expert_linkedin)
            $('#main-industry').val(main_industry).trigger('change');
            sub_industry_classification = sub_industry;
            $('#sub-industry').empty();
            $('#modal_industry').modal('show');
        }

        function remove(id){
            Swal.fire({
                title: 'Confirm Remove?',
                text: "This will also remove all the data associated with this expert including already scraped data",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `Remove`,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return $.ajax({
                        url: `{{route('admin.experts.destroy','')}}/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: "{{csrf_token()}}",
                        },
                        success: function (data) {
                            Swal.fire(
                                'Deleted!',
                                'Expert has been deleted.',
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
            let expert_id = $('#expert_id').val();
            let industry_val = $('#sub-industry').val();
            $.ajax({
                url: '{{route('admin.experts.industry')}}',
                method: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    expert_id: expert_id,
                    industry_val: industry_val,
                },
                success: function (response) {
                    _Swal.success('Industry Updated', response.message, function () {
                        $('#modal_industry').modal('hide');
                        table.ajax.reload(null, false);
                    })
                },
                error: function (response) {
                    _Swal.error(response.responseJSON.message)
                }
            });
        }

        function setEmail(id, email) {
            Swal.fire({
                title: 'Set Email',
                input: 'text',
                inputLabel: 'Contact',
                inputPlaceholder: 'Enter email',
                inputValue: email !== 'null' ? email : ' ',
                showCancelButton: true,
                confirmButtonText: 'Set',
                showLoaderOnConfirm: true,
                preConfirm: (email) => {
                    return $.ajax({
                        url: '{{route('admin.experts.set-contact')}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            expert_id: id,
                            email: email
                        },
                        success: function (data) {
                            _Swal.success(data.message);
                            table.ajax.reload(null, false);
                        },
                        error: function (data) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            )
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

        function setPhone(id, phone) {
            Swal.fire({
                title: 'Set Phone',
                input: 'text',
                inputLabel: 'Contact',
                inputPlaceholder: 'Enter phone',
                inputValue: phone !== 'null' ? phone : ' ',
                showCancelButton: true,
                confirmButtonText: 'Set',
                showLoaderOnConfirm: true,
                preConfirm: (phone) => {
                    return $.ajax({
                        url: '{{route('admin.experts.set-contact')}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            expert_id: id,
                            phone: phone
                        },
                        success: function (data) {
                            _Swal.success(data.message);
                            table.ajax.reload(null, false);
                        },
                        error: function (data) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            )
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

    </script>
@endpush
