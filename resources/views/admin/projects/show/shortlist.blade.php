<div class="nk-block-between mt-3">
    <div class="nk-block-head-content">
        <h6 class="title mb-1 pb-1">Project Experts</h6>
    </div>
</div>
<div class="card card-bordered card-preview">

    <div class="card-inner position-relative card-tools-toggle py-3">
        <div class="card-title-group">
            <div class="card-tools">
                <div class="form-inline flex-nowrap gx-3">
                    <button id="add_expert_btn" class="btn btn-sm btn-outline-info hover:tw-text-white hover:tw-bg-blue-500 {{$project->status == 'pending' ? 'disabled' : ''}}" onclick="openModal()"><em class="icon ni ni-plus"></em><span>Add</span></button>
                    <button id="invite_all" class="btn btn-sm ms-2 bg-outline-info hover:tw-text-white hover:tw-bg-blue-500 {{$project->status == 'pending' ? 'disabled' : ''}}" onclick="inviteAll()"><i class="fa-solid fa-envelope fs-6 tw-ms-0.5 me-3"></i><span>Invite</span></button>
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
                                        <a href="#" class="btn btn-trigger btn-icon search-toggle toggle-search"
                                           data-target="search"><em class="icon ni ni-search"></em></a>
                                    </li>
                                    <li>
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                               data-bs-togglese="dropdown">
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
                                                    <li>
                                                        <a class="export-btn py-2 clickable" val="excel">
                                                            <span><i class="fa-solid fa-file-excel fs-7 me-1"></i>ExportExcel</span>
                                                        </a>
                                                    </li>
                                                    <li><a class="export-btn py-2 clickable" val="pdf">
                                                            <span><i class="fa-solid fa-file-pdf fs-7 me-1"></i> Export Pdf</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="export-btn py-2 clickable" val="print">
                                                            <span><i class="fa-solid fa-print fs-7 me-1"></i>Print Table</span>
                                                        </a>
                                                    </li>
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
                    <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em
                            class="icon ni ni-arrow-left"></em></a>
                    <input type="text" class="form-control border-transparent form-focus-none" id="searchbar"
                           placeholder="Search user, email, linkedin">
                    <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                </div>
            </div>
        </div>
    </div>


    <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
        <thead>
            <tr class="nk-tb-item nk-tb-head">
                <th class="nk-tb-col"><span class="sub-text">Expert</span></th>
                <th class="nk-tb-col"><span class="sub-text">Contact</span></th>
                <th class="nk-tb-col"><span class="sub-text">Invited</span></th>
                <th class="nk-tb-col"><span class="sub-text">Accept?</span></th>
                <th class="nk-tb-col"><span class="sub-text">Answer</span></th>
                <th class="nk-tb-col"><span class="sub-text">Awarded</span></th>
                <th class="nk-tb-col"><span class="sub-text">Payment</span></th>
                <th class="nk-tb-col"><span class="sub-text">Contract</span></th>
                <th class="nk-tb-col nk-tb-col-tools text-end noExport">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@push('scripts')
    <script>
        datatableInit('#datatable', {
            ajax: '{{route('admin.projects.datatable_expert', $project->pid)}}',
            order:  false,
            columnDefs: [
                { "className": "nk-tb-col", targets: '_all'},
                {
                    "targets": [0],
                    "width": "30%",
                },
                {
                    "className": "clickable",
                    width: "20%",
                    "targets": [0],
                    "createdCell": function (td, cellData, rowData) {
                        $(td).on('click', () => window.location.href = `{{route('admin.expert-portal.index','')}}/${rowData.expert.id}`);
                    }
                }
            ],
            columns: [
                {
                    data: 'expert',
                    render: function (data, type, row) {
                        return `<div class="user-card">
                            <div class="user-avatar bg-dim-primary d-flex position-relative !tw-w-12 !tw-h-12 !tw-rounded-lg !tw-bg-slate-300">
                                <span>${data.img_url ? `<img class="!tw-rounded-lg" src="${data.img_url}" alt="">` : `<img class="!tw-rounded-lg p-2" src="/images/svg/avatar.svg" alt="">`}
                                ${row.registered ? `<i class="fa-solid fa-badge-check fs-18px text-info position-absolute tw-top-0 translate-middle"></i>` : ''}
                                </span>
                            </div>
                            <div class="user-info">
                                <span class="tb-lead fs-15px">${data.name}</span>
                                <span class="fs-13px"><i class="fa-brands tw-text-blue-500 fa-linkedin me-1"></i>${data.url.replace('https://www.linkedin.com/in/','')}</span>
                            </div>
                        </div>`;
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
                    data: 'invited',
                    render: function (data) {
                        if (!data) return '-';
                        let color = data === true ? 'success' : 'danger'
                        return `<span class="badge bg-${color} text-capitalize">${data ? 'Yes' : 'No'}</span>`;
                    }
                },
                {
                    data: 'accepted',
                    render: function (data, type, row) {
                        if (data === null) return '-';
                        let color = data ? 'success' : 'danger'
                        return `<span class="badge bg-${color} text-capitalize">${data ? 'Accept' : ('Reject')}</span>`;
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
                    data: 'awarded',
                    render: function (data, type, row) {
                        if (!data) return '-';
                        return `<i class="fa-solid text-success fa-circle-check fs-4"></i>`;
                    }
                },
                {
                    data: 'payment',
                    render: function (data, type, row) {
                        if (!data) return '-';
                        return data;
                    }
                },
                {
                    data: 'contract',
                    render: function (data, type, row) {
                        if (!data) return '-';
                        return data;
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
                                                <li><a class="clickable" onclick="invite(${row.expert_id}, ${row.invited})"><em class="icon ni ni-user-add"></em><span>Invite To Project</span></a></li>
                                                <li><a class="clickable" onclick="award(${row.expert_id})"><i class="fa-regular fa-award fs-5 tw-me-5"></i><span>Award Project</span></a></li>
                                                <li><div class="dropdown-divider my-1"></div></li>
                                                <li><a class="clickable" onclick="set_contract(${row.expert_id})"><i class="fa-regular fa-file-signature fs-15px tw-me-4"></i><span>Contract</span></a></li>
                                                <li><a class="clickable" onclick="set_payment(${row.expert_id})"><i class="fa-regular fa-money-bill fs-15px tw-me-4"></i><span>Set Payment</span></a></li>
                                                <li><div class="dropdown-divider my-1"></div></li>
                                                <li><a class="clickable" onclick="force_accept(${row.expert.id})"><em class="icon ni ni-check"></em><span>Force Accept</span></a></li>
                                                <li><a class="clickable" onclick="remove(${row.expert_id})"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>`
                    },
                },
            ]
        }, 'datatable');

        function remove(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "Remove this expert from the shortlist?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.remove-expert', ['pid' => $project->pid, ''])}}/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            window['datatable'].ajax.reload();
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

        function invite(expert_id, invited) {
            if (invited) {
                Swal.fire({
                    title: 'Already Invited',
                    text: "Do you want to send invitation again?",
                    icon: 'info',
                    showCancelButton: true,
                    cancelButtonText: 'View Email',
                }).then((result) => {
                    if (result.isConfirmed){
                        _Swal.loading('Sending invitation', 'Pleas wait...');
                        $.ajax({
                            url: '{{route('admin.projects.invite-expert',['project_id' => $project->id, ''])}}/' + expert_id,
                            type: 'GET',
                            data: {
                                _token: '{{csrf_token()}}'
                            },
                            success: function (data) {
                                Swal.close();
                                _Swal.success(data.message);
                                window['datatable'].ajax.reload();
                            },
                            error: function (data) {
                                _Swal.error(data.responseJSON.message)
                            }
                        });
                    }
                    else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.open('{{route('admin.email_project_view', $project->pid)}}', '_blank');
                    }
                });
            }
            else{
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Send invitation to this expert?",
                    icon: 'info',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        _Swal.loading('Sending invitation', 'Pleas wait...');
                        $.ajax({
                            url: '{{route('admin.projects.invite-expert',['project_id' => $project->id, ''])}}/' + expert_id,
                            type: 'GET',
                            data: {
                                _token: '{{csrf_token()}}'
                            },
                            success: function (data) {
                                Swal.close();
                                _Swal.success(data.message);
                                window['datatable'].ajax.reload();
                            },
                            error: function (data) {
                                _Swal.error(data.responseJSON.message)
                            }
                        });
                    }
                });
            }
        }

        function openModal() {
            $('#modal-expert-list').modal('show');
        }

        function inviteAll(){
            Swal.fire({
                title: 'Send Invitation to Everyone?',
                text: "Send invitation to all uninvited shortlisted expert? Already send invitation will not be send again. Confirm?",
                icon: 'info',
                showCancelButton: true,
                cancelButtonText: 'View Email',
            }).then((result) => {
                if (result.isConfirmed) {
                    _Swal.loading('Sending invitation', 'Pleas wait...');
                    $.ajax({
                        url: '{{route('admin.projects.invite-expert-all',['project_id' => $project->id])}}',
                        type: 'GET',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            Swal.close();
                            _Swal.success(data.message);
                            window['datatable'].ajax.reload();
                        },
                        error: function (data) {
                            _Swal.error(data.responseJSON.message)
                        }
                    });
                }
                else if (result.dismiss === Swal.DismissReason.cancel) {
                    window.open('{{route('admin.email_project_view', $project->pid)}}', '_blank');
                }
            })
        }

        function award(expert_id){
            // get the number of expert that accept the invitation
            Swal.fire({
                title: 'Award Project to Expert?',
                text: "Proceed to awarding project to this expert?",
                icon: 'info',
                showCancelButton: true,

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.award', ['project_id' => $project->id, ''])}}/' + expert_id,
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            _Swal.success(data.message);
                            window['datatable'].ajax.reload();
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
            });
        }

        function force_accept(expert_id){
            Swal.fire({
                title: 'Force Accept Invitation?',
                text: "Force accept the invitation for this expert? This will bypass the expert decision to accept or reject the invitation.",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.force-accept', ['project_id' => $project->id, ''])}}/' + expert_id,
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            _Swal.success(data.message);
                            window['datatable'].ajax.reload();
                        },
                        error: function (data) {
                            _Swal.error(data.responseJSON.message)
                        }
                    });
                }
            });
        }

        function set_payment(expert_id){
            // create Swal with input field
            Swal.fire({
                title: 'Set Payment',
                input: 'text',
                inputLabel: 'Payment Amount',
                inputAttributes: {
                    autocapitalize: 'off',
                    placeholder: 'Eg: USD3000'
                },
                showCancelButton: true,
                confirmButtonText: 'Set Payment',
                showLoaderOnConfirm: true,
                preConfirm: (payment_amount) => {
                    return $.ajax({
                        url: '{{route('admin.projects.set-payment', ['project_id' => $project->id, ''])}}/' + expert_id,
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            payment_amount: payment_amount
                        },
                    }).then((response) => {
                        return response;
                    }).catch((error) => {
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    _Swal.success(result.value.message);
                    window['datatable'].ajax.reload();
                }
            })
        }

    </script>
@endpush
