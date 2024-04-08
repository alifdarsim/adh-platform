<div class="nk-block-head-content mt-3">
    <h5 class="title pb-1">List of Expert that Accept the Project</h5>
</div>
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
                               id="searchbar" placeholder="Search Expert Name">
                    </div>
                </div>
            </div>
            <div class="btn btn-sm ms-2 bg-danger text-white" onclick="awarded()"><i class="fa-solid fa-award fs-6 tw-ms-0.5 me-3"></i><span>Award Selected Expert</span></div>
        </div>
    </div>
    <table id="datatable3" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
        <thead>
        <tr class="nk-tb-item nk-tb-head">
            <th class="nk-tb-col nk-tb-col-check">
                <div class="custom-control custom-control-sm custom-checkbox notext">
                    <input type="checkbox" class="custom-control-input" id="uid">
                    <label class="custom-control-label" for="uid"></label>
                </div>
            </th>
            <th class="nk-tb-col"><span class="sub-text">Expert</span></th>
            <th class="nk-tb-col"><span class="sub-text">Contact</span></th>
            <th class="nk-tb-col"><span class="sub-text">Answer</span></th>
            <th class="nk-tb-col"><span class="sub-text">Details</span></th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@push('scripts')
    <script>
        function fetchAwardList(){
            datatableInit('#datatable3', {
                ajax: '{{route('admin.projects.datatable_awarding', $project->pid)}}',
                order: false,
                columnDefs: [
                    {"className": "nk-tb-col", targets: '_all'},
                    {"className": "nk-tb-col nk-tb-col-check", targets: [0]},

                ],
                simpleTable: true,
                columns: [
                    {
                        data: 'expert',
                        render: function (data, type, row) {
                            return ` <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid${data.id}">
                                        <label class="custom-control-label" for="uid${data.id}"></label>
                                    </div>`;
                        }
                    },
                    {
                        data: 'expert',
                        render: function (data, type, row) {
                            return `
                        <div class="d-flex justify-between justify-center tw-items-center">
                            <div class="user-card">
                                <div class="user-avatar bg-dim-primary d-none d-sm-flex"><span>${data.img_url ? `<img src="${data.img_url}" alt="">` : `<span class="text-white">N/A</span>`}</span></div>
                                <div class="user-info">
                                    <span class="fs-17px me-1 text-dark">${data.name}</span>
                                    <span class="fs-17px me-2">${data.registered ? '<i class="fa-solid fa-badge-check text-info"></i>' : ''}</span>
                                    <p class="mb-0"><span class="fs-13px">${data.address}, ${data.country}</span></p>
                                    <a class="tw-text-slate-500 tw-underline hover:tw-text-blue-500" href="${data.url}"  target="_blank"><i class="fa-brands text-info fa-linkedin fs-6 me-1"></i>${data.url.replace('https://www.linkedin.com/in/','')}</a>
                                </div>
                            </div>
                        </div>`
                        }
                    },
                    {
                        data: 'expert',
                        render: function (data, type, row) {
                            let email = `<div class="d-flex tw-items-center"><i class="fa-solid fs-11px me-1 fa-envelope"></i>${row.expert.email === null ? '<i class="fa-solid fa-xmark text-danger me-1"></i>' : row.expert.email}</div>`;
                            let phone = `<div class="d-flex tw-items-center"><i class="fa-solid fs-11px me-1 fa-phone"></i>${row.expert.phone === null ? '<i class="fa-solid fa-xmark text-danger me-1"></i>' : row.expert.phone}</div>`;
                            return email + phone;
                        }
                    },
                    {
                        data: 'answers',
                        className: 'clickable hover:tw-bg-slate-200 items-center answer-cell',
                        render: function (data) {
                            if (data === null) return '-';
                            return data.map((answer, index) => {
                                return `<span class="fs-12px">Q${index+1}</span> <i class="fa-solid ${answer === null ? 'fa-circle-xmark text-danger' : 'fa-circle-check text-success'} fs-6"></i>`;
                            }).join(' ');
                        }
                    },
                    {
                        data: 'id',
                        render: function (data, type, row) {
                            return `<a class="btn btn-sm btn-info clickable" onclick="expert_detail(${row.expert.id})"><span>Expert Details</span></a>`
                        },
                    },
                ]
            }, 'datatable3');
        }

        {{--function awarded(id) {--}}
        {{--    Swal.fire({--}}
        {{--        title: 'Confirm Award?',--}}
        {{--        text: "Award this project to this expert? This will mark the project as 'Awarded'. Confirm?",--}}
        {{--        icon: 'info',--}}
        {{--        showCancelButton: true,--}}
        {{--    }).then((result) => {--}}
        {{--        if (result.isConfirmed) {--}}
        {{--            $.ajax({--}}
        {{--                url: '{{route('admin.projects.award-expert', ['pid' => $project->pid])}}',--}}
        {{--                type: 'POST',--}}
        {{--                data: {--}}
        {{--                    _token: '{{csrf_token()}}',--}}
        {{--                    expert_id: id--}}
        {{--                },--}}
        {{--                success: function (data) {--}}
        {{--                    Swal.fire('Success!', data.message, 'success').then(function () {--}}
        {{--                        location.reload();--}}
        {{--                    });--}}
        {{--                },--}}
        {{--                error: function (data) {--}}
        {{--                    Swal.fire(--}}
        {{--                        'Error!',--}}
        {{--                        'Something went wrong.',--}}
        {{--                        'error'--}}
        {{--                    )--}}
        {{--                }--}}
        {{--            });--}}
        {{--        }--}}
        {{--    })--}}
        {{--}--}}

        function awarded() {
            let expert_ids = [];
            $('#datatable3 tbody input[type="checkbox"]:checked').each(function () {
                expert_ids.push($(this).attr('id').replace('uid', ''));
            });
            if (expert_ids.length === 0) {
                Swal.fire('Error!', 'Please select at least one expert to award.', 'warning');
                return;
            }
            Swal.fire({
                title: 'Confirm Award?',
                text: "Award this project to selected expert(s)? This will mark the project as 'Awarded'. Confirm?",
                icon: 'info',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.award-expert', ['pid' => $project->pid])}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            expert_ids: expert_ids
                        },
                        success: function (data) {
                            Swal.fire('Success!', data.message, 'success').then(function () {
                                location.reload();
                            });
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

        fetchAwardList();

        $('#uid').on('change', function () {
            if ($(this).is(':checked')) {
                $('#datatable3 tbody input[type="checkbox"]').prop('checked', true);
            } else {
                $('#datatable3 tbody input[type="checkbox"]').prop('checked', false);
            }
        });

        //if all checkboxes are selected, check the main checkbox
        $('#datatable3 tbody').on('change', 'input[type="checkbox"]', function () {
            if ($('#datatable3 tbody input[type="checkbox"]:checked').length === $('#datatable3 tbody input[type="checkbox"]').length) {
                $('#uid').prop('checked', true);
            } else {
                $('#uid').prop('checked', false);
            }
        });
    </script>
@endpush
