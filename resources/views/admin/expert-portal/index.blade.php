@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between g-3">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                    <a class="back" href="javascript:history.back()"><i
                            class="fa-solid fa-arrow-left me-2 fs-4"></i></a>
                    Expert Portal</h3>
                <div class="nk-block-des text-soft">
                    <p>Details of the expert</p>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="row gx-3">
            <div class="col-12">
                <div class="card card-bordered">
                    <div class="card-inner-group">
                        <div class="card-inner row pb-1">
                            <div class="col-3">
                                <div class="user-card user-card-s2 pt-0 pb-0">
                                    <div class="user-avatar lg bg-primary !tw-rounded-lg !tw-w-20 !tw-h-20 ">
                                        <img class=" !tw-w-20 !tw-h-20 !tw-rounded-lg !tw-bg-slate-200" src="/images/svg/avatar.svg" alt="" id="avatar">
                                    </div>
                                    <div class="user-info mt-0">
                                        <div class="badge bg-info rounded-pill mb-2" id="registered">REGISTERED</div>
                                        <h5 id="name" class="mb-0"></h5>
                                        <span class="sub-text" id="email"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="card-inner py-0 pb-3">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="card card-bordered bg-info py-1">
                                                <span class="fw-bolder text-white fs-20px" id="project_total">-</span>
                                                <span class="sub-text text-white">Total Project</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card card-bordered bg-success py-1">
                                                <span class="fw-bolder text-white fs-20px" id="project_completed">-</span>
                                                <span class="sub-text text-white">Completed Project</span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card card-bordered bg-warning py-1">
                                                <span class="fw-bolder text-white fs-20px" id="project_ongoing">-</span>
                                                <span class="sub-text text-white">Ongoing Project</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-inner">
                                    <h6 class="overline-title mb-2">Expert Basic Information</h6>
                                    <div class="row g-3">
                                        <div class="col-sm-3">
                                            <span class="sub-text">LinkedIn:</span>
                                            <a href="" id="linkedin" class="tw-text-blue-500 fs-12px" target="_blank"><i class="text-info me-1 fa-brands fa-linkedin"></i><span>-</span></a>
                                        </div>
                                        <div class="col-sm-3">
                                            <span class="sub-text">Country:</span>
                                            <span class="fs-16px" id="country">-</span>
                                        </div>
                                        <div class="col-sm-3">
                                            <span class="sub-text">Last Login:</span>
                                            <span class="fs-14px" id="last_login">-</span>
                                        </div>
                                        <div class="col-sm-3">
                                            <span class="sub-text">Register At:</span>
                                            <span class="fs-14px" id="register_at">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                        <div class="card-inner card-inner-sm">--}}
{{--                            <ul class="btn-toolbar justify-center gx-1">--}}
{{--                                <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-shield-off"></em></a></li>--}}
{{--                                <li><a onclick="messageOpen()" class="btn btn-trigger btn-icon"><em class="icon ni ni-mail"></em></a></li>--}}
{{--                                <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-bookmark"></em></a></li>--}}
{{--                                <li><a href="#" class="btn btn-trigger btn-icon text-danger"><em class="icon ni ni-na"></em></a></li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="card card-bordered">
                    <div class="card-inner">
                        <ul class="nav nav-tabs mt-n3">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabHistoryOngoing">Ongoing Project</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabHistoryComplete">Completed Project</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabDetails">Expert Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabPayment">Preferred Payment</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabHistoryOngoing">
                                <div class="nk-block">
                                    <h6 class="lead-text mb-3">Ongoing Project<span data-bs-toggle="tooltip" data-bs-placement="top" title="Show project that has is is ongoing and currently shortlisted." class="ms-1"><i class="fa-solid fa-circle-info"></i></span></h6>
                                    <div class="card card-bordered card-preview">
                                        <table id="datatable_project_ongoing" class="datatable-init nk-tb-list nk-tb-ulist expert_table" data-auto-responsive="true">
                                            <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Project</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Payment</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Contract</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabHistoryComplete">
                                <div class="nk-block">
                                    <h6 class="lead-text mb-3">Completed Project History<span data-bs-toggle="tooltip" data-bs-placement="top" title="Show project that has been completed." class="ms-1"><i class="fa-solid fa-circle-info"></i></span></h6>
                                    <div class="card card-bordered card-preview">
                                        <table id="datatable_project_complete" class="datatable-init nk-tb-list nk-tb-ulist expert_table" data-auto-responsive="true">
                                            <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Project</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Payment</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Contract</span></th>
                                                <th class="nk-tb-col tb-col-lg"><span class="sub-text">Action</span></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabPayment">
                                <div class="nk-block">
                                    <h6 class="lead-text mb-3">Expert Chosen Payment Method</h6>
                                    <div class="row g-3">
                                        <div class="col-xl-12 col-xxl-6">
                                            <div class="card card-bordered">
                                                <div class="card-inner py-1">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <div class="ms-3">
                                                                <span class="lead-text"><span class="text-soft ml-1">Direct Transfer: </span>OCBC Bank</span>
                                                                <span class="lead-text"><span class="text-soft ml-1">Bank Account: </span>5818558552965</span>
                                                            </div>
                                                        </div>
                                                        <ul class="btn-toolbar justify-center gx-1 me-n1 flex-nowrap">
                                                            <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-copy"></em></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane row" id="tabDetails">
                                <div class="col-12">
                                    <h6 class="fs-16px text-info"><i class="fa-solid fa-user-tie me-1"></i>About</h6>
                                    <p class="fs-13px" id="expert_about"></p>
                                </div>
                                <div class="col-12 mt-4">
                                    <h6 class="fs-16px text-info"><i class="fa-solid fa-industry me-1"></i>Industry</h6>
                                    <div class="d-flex gx-2">
                                        <div>Main Industry: <span class="badge badge-sm rounded-pill bg-outline-secondary me-1 mb-1 !tw-py-0.5" id="expert_main_industry"></span></div>
                                        <div>Sub Industry: <span class="badge badge-sm rounded-pill bg-outline-secondary me-1 mb-1 !tw-py-0.5" id="expert_sub_industry"></span></div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <h6 class="fs-16px text-info"><i class="fa-solid fa-briefcase me-1"></i>Work Experiences</h6>
                                    <div class="nk-tb-list nk-tb-ulist is-compact border round-sm" id="expert_experiences_container">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col">
                                                <span class="fw-bold sub-text tw-text-slate-500">Company</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="fw-bold sub-text tw-text-slate-500">Positions</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="fw-bold sub-text tw-text-slate-500">Location</span>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="fw-bold sub-text tw-text-slate-500">Duration</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <h6 class="fs-16px text-info"><i class="fa-solid fa-user-helmet-safety me-1"></i>Skills</h6>
                                    <div id="expert_skills"></div>
                                </div>
                                <div class="col-12 mt-4">
                                    <h6 class="fs-16px text-info"><i class="fa-solid fa-briefcase me-1"></i>Languages</h6>
                                    <div id="expert_languages"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.expert-portal.modals.message')
    @include('admin.expert-portal.modals.contract')
    @include('admin.expert-portal.modals.default_contract')

@endsection

@push('scripts')
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>
    <script>

        datatableInit('#datatable_project_ongoing', {
            ajax: '{{ route('admin.expert-portal.datatable_ongoing', '') }}/{{ $id }}',
            simpleTable: true,
            order: [
                [3, 'desc']
            ],
            columnDefs: [{
                "orderable": false,
                "targets": [0, 1, 2, 3]
            },
                {
                    "className": "nk-tb-col",
                    "targets": "_all"
                },
            ],
            pageLength: localStorage.getItem(window.location.pathname + '_pagination') || 10,
            columns: [
                {
                    data: 'project',
                    render: function(data, type, row) {
                        return `<div class="user-info">
                                    <a href="{{ route('admin.projects.show', '') }}/${data.pid}" class="fs-14px text-info">${data.name}</a>
                                    <span class="sub-text">ID: #${data.pid}</span>
                                    <span class="sub-text">Expert Status: <span class="badge badge-xs ms-1 tw-w-18 center text-capitalize fw-bold bg-${row.status === 'ongoing' ? 'info' : 'secondary'}">${row.status}</span></span>
                                 </div>`
                    }
                },
                {
                    data: 'payment',
                    render: function(data) {
                        return `<div class="d-flex">
                            <div class="user-info">
                                <span class="sub-text">Status: <span class="badge tw-w-14 center badge-xs ms-1 text-capitalize fw-bold bg-${data && data.status ? (data.status === 'pending' ? 'warning' : 'success') : '-'}">${data && data.status ? data.status : '-'}</span></span>
                                <span class="sub-text py-1">Amount: <span class="tw-ms-1 fw-bold fs-13px">${data && data.amount ? data.amount : '-'}</span></span>
                                <span class="sub-text">Paid On: ${data && data.payment_date ? dayjs(data.payment_date).format('DD MMM YYYY') : '-' }</span>
                            </div>
                            <div class="ms-2">
                                <div>Invoice : <a target="_blank" href="../../${data && data.invoice_path ? data.invoice_path : '#'}" class="btn btn-sm bg-info text-white ${data && data.invoice_path ? '' : 'disabled'}"><i class="fa-solid fa-file-invoice"></i></a></div>
                                <div class="mt-1">Receipt: <a href="../../${data && data.receipt_path ? data.receipt_path : '#'}" class="btn btn-sm bg-info text-white ${data && data.receipt_path ? '' : 'disabled'}"><i class="fa-solid fa-receipt"></i></a></div>
                            </div>
                        </div>`
                    }
                },
                {
                    data: 'contract',
                    "render": function(data, type, row) {
                        console.log(data)
                        let state1 = data.find(x => x.state === '1')
                        let state2 = data.find(x => x.state === '2')
                        let state3 = data.find(x => x.state === '3')
                        console.log(state1)
                        return `<div>
                                <div>Contract: <a href="../../${state1 && state1.filepath ? state1.filepath : '#'}" class="btn btn-sm bg-info text-white ${state1 && state1.filepath ? '' : 'disabled'}"><i class="fa-solid fa-file-contract"></i></a></div>
                                <div class="mt-1">Signed: <a href="../../${state2 && state2.filepath ? state2.filepath : '#'}" class="btn btn-sm bg-info text-white ${state2 && state2.filepath ? '' : 'disabled'}"><i class="fa-solid fa-file-signature"></i></a></div>
                                <div class="mt-1">Verified: <a href="../../${state3 && state3.filepath ? state3.filepath : '#'}" class="btn btn-sm bg-info text-white ${state3 && state3.filepath ? '' : 'disabled'}"><i class="fa-solid fa-file-check"></i></a></div>
                            </div>`;
                    }
                },
                {
                    data: 'id',
                    className: 'nk-tb-col-tools',
                    render: function(data, type, row) {
                        return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a class="clickable" onclick="setPayment('${row.id}','${row.project.name}')"><i class="fa-regular fa-money-check-dollar fs-5 me-2"></i><span>Payment Details</span></a></li>
                                                <li><a class="clickable" onclick="setContract('${row.id}','${row.project.name}')"><i class="fa-regular fa-file-signature fs-6 me-2"></i><span>Contract Details</span></a></li>
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

        datatableInit('#datatable_project_complete', {
            ajax: '{{ route('admin.expert-portal.datatable_complete', '') }}/{{ $id }}',
            simpleTable: true,
            order: [
                [3, 'desc']
            ],
            columnDefs: [{
                "orderable": false,
                "targets": [0, 1, 2, 3]
            },
                {
                    "className": "nk-tb-col",
                    "targets": "_all"
                },
            ],
            pageLength: localStorage.getItem(window.location.pathname + '_pagination') || 10,
            columns: [
                {
                    data: 'project',
                    render: function(data, type, row) {
                        return `<div class="user-info">
                                    <a href="{{ route('admin.projects.show', '') }}/${data.pid}" class="fs-14px text-info">${data.name}</a>
                                    <span class="sub-text">ID: #${data.pid}</span>
                                    <span class="sub-text">Status: <span class="badge badge-xs ms-1 tw-w-18 center text-capitalize fw-bold bg-${row.status === 'completed' ? 'success' : 'secondary'}">${row.status}</span></span>
                                 </div>`
                    }
                },
                {
                    data: 'payment',
                    render: function(data,type, row) {
                        return `<div class="d-flex">
                            <div class="user-info">
                                <span class="sub-text">Status: <span class="badge tw-w-14 center badge-xs ms-1 text-capitalize fw-bold bg-${data && data.status ? (data.status === 'pending' ? 'warning' : 'success') : '-'}">${data && data.status ? data.status : '-'}</span></span>
                                <span class="sub-text py-1">Amount: <span class="tw-ms-1 fw-bold fs-13px">${data && data.amount ? data.amount : '-'}</span></span>
                                <span class="sub-text">Paid On: ${data && data.payment_date ? dayjs(data.payment_date).format('DD MMM YYYY') : '-' }</span>
                            </div>
                            <div class="ms-2">
                                <div>Invoice : <a target="_blank" href="../../${data && data.invoice_path ? data.invoice_path : '#'}" class="btn btn-sm bg-info text-white ${data && data.invoice_path ? '' : 'disabled'}"><i class="fa-solid fa-file-invoice"></i></a></div>
                                <div class="mt-1">Receipt: <a href="../../${data && data.receipt_path ? data.receipt_path : '#'}" class="btn btn-sm bg-info text-white ${data && data.receipt_path ? '' : 'disabled'}"><i class="fa-solid fa-receipt"></i></a></div>
                            </div>
                        </div>`
                    }
                },
                {
                    data: 'contract',
                    "render": function(data, type, row) {
                        console.log(data)
                        let state1 = data.find(x => x.state === '1')
                        let state2 = data.find(x => x.state === '2')
                        let state3 = data.find(x => x.state === '3')
                        console.log(state1)
                        return `<div>
                                <div>Contract: <a href="../../${state1 && state1.filepath ? state1.filepath : '#'}" class="btn btn-sm bg-info text-white ${state1 && state1.filepath ? '' : 'disabled'}"><i class="fa-solid fa-file-contract"></i></a></div>
                                <div class="mt-1">Signed: <a href="../../${state2 && state2.filepath ? state2.filepath : '#'}" class="btn btn-sm bg-info text-white ${state2 && state2.filepath ? '' : 'disabled'}"><i class="fa-solid fa-file-signature"></i></a></div>
                                <div class="mt-1">Verified: <a href="../../${state3 && state3.filepath ? state3.filepath : '#'}" class="btn btn-sm bg-info text-white ${state3 && state3.filepath ? '' : 'disabled'}"><i class="fa-solid fa-file-check"></i></a></div>
                            </div>`;
                    }
                },
                {
                    data: 'id',
                    className: 'nk-tb-col-tools',
                    render: function(data, type, row) {
                        return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a class="clickable" onclick="setPayment('${row.id}','${row.project.name}')"><i class="fa-regular fa-money-check-dollar fs-5 me-2"></i><span>Payment Details</span></a></li>
                                                <li><a class="clickable" onclick="setContract('${row.id}','${row.project.name}')"><i class="fa-regular fa-file-signature fs-6 me-2"></i><span>Contract Details</span></a></li>
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


        $.ajax({
            url: '{{ route('admin.expert-portal.get', $id) }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#avatar').attr('src', response.expert.img_url ?? '/images/svg/avatar.svg');
                $('#name').html(response.name);
                $('#email').text(response.email);
                $('#registered').text(response.expert.registered);
                $('#linkedin').attr('href', response.expert.url);
                $('#linkedin').find('span').text(response.expert.url.replace('https://www.linkedin.com/in/', ''));
                let industryText = 'Not set';
                if (response.expert.industry) {
                    let industryMain = response.expert.industry.main ?? 'Not set';
                    let industrySub = response.expert.industry.sub ?? 'Not set';
                    industryText = `${industryMain} - ${industrySub}`;
                }
                $('#industry').text(industryText);
                $('#last_login').text(response.last_login ?? '-');
                $('#register_at').text(response.register_at ?? '-');
                $('#address').text(response.expert.address);
                $('#country').text(response.expert.country);
                $('#project_total').text(response.project_count);
                $('#project_completed').text(response.project_completed);
                $('#project_ongoing').text(response.project_ongoing);
                // $('#avatar_chat').attr('src', response.expert.img_url);
            }
        });

        $.ajax({
            url: '{{ route('admin.expert-portal.expert_details', $id) }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#expert_about').html(response.about);
                let skills_badges = '';
                response.skills.forEach(skill => {
                    skills_badges += `<span class="badge badge-sm rounded-pill bg-outline-secondary me-1 mb-1 !tw-py-0.5">${skill}</span>`;
                });
                $('#expert_skills').html(skills_badges);
                let languages_badges = '';
                response.languages.forEach(language => {
                    languages_badges += `<span class="badge badge-sm rounded-pill bg-outline-secondary me-1 mb-1 !tw-py-0.5">${language}</span>`;
                });
                $('#expert_languages').html(languages_badges);
                let experiences = response.experiences;
                let experiencesContainer = $('#expert_experiences_container');
                if (experiences.length > 0) {
                    // experiencesContainer.empty();
                    experiences.forEach(experience => {
                        let html = `
                               <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span>${experience.company}</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span>${experience.position}</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span>${experience.location}</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span>${experience.duration}</span>
                                    </div>
                                 </div>`;
                        experiencesContainer.append(html);
                    });
                }
                $('#expert_main_industry').text(response.industry ? response.industry.main : '-');
                $('#expert_sub_industry').text(response.industry ? response.industry.sub : '-');
            },
            error: function (response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
        });

    </script>
@endpush
