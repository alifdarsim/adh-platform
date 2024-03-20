<div class="nk-block-between mt-3">
    <div class="nk-block-head-content">
        <h6 class="title mb-1 pb-1">Expert Shortlisting</h6>
    </div>
</div>
<div class="card card-bordered card-preview">
    <div class="card-inner position-relative card-tools-toggle py-3">
        <h6 class="fs-14px">Add expert from Expert list to the potential shortlisted expert.</h6>
        <div class="card-title-group">
            <div class="card-tools w-100">
                <ul class="btn-toolbar d-block">
                    <div class="d-flex justify-between d-block">
                        <div>
                            <button id="add_expert_btn" class="btn btn-sm bg-info  text-white hover:tw-text-white hover:tw-bg-blue-500 {{$project->status == 'pending' ? 'disabled' : ''}}" onclick="openModal()"><em class="icon ni ni-plus"></em><span>Add Shortlisted Expert</span></button>
                            <button id="invite_all" class="btn btn-sm ms-2 bg-info text-white hover:tw-text-white hover:tw-bg-blue-500 {{$project->status == 'pending' ? 'disabled' : ''}}" onclick="inviteAll()"><i class="fa-solid fa-envelope fs-6 tw-ms-0.5 me-3"></i><span>Invite All</span></button>
                        </div>
                        <div class="btn btn-sm ms-2 bg-danger text-white" onclick="awardProject()"><i class="fa-solid fa-award fs-6 tw-ms-0.5 me-3"></i><span>Proceed to Awarding Project</span></div>
                    </div>
                </ul>
            </div>
        </div>
    </div><!-- .card-inner -->
    <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
        <thead>
            <tr class="nk-tb-item nk-tb-head">
                <th class="nk-tb-col"><span class="sub-text">Expert</span></th>
                <th class="nk-tb-col"><span class="sub-text">Contact</span></th>
                <th class="nk-tb-col"><span class="sub-text">Invited</span></th>
                <th class="nk-tb-col"><span class="sub-text">Accept?</span></th>
                <th class="nk-tb-col"><span class="sub-text">Answer</span></th>
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
            ajax: '{{route('admin.projects.datatable_shortlist', $project->pid)}}',
            order:  false,
            columnDefs: [
                { "className": "nk-tb-col", targets: '_all'},
                {
                    "targets": [0],
                    "width": "40%",
                }
            ],
            simpleTable: true,
            columns: [
                {
                    data: 'expert',
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex justify-between justify-center tw-items-center">
                             <div class="user-card">
                                <div class="user-avatar bg-dim-primary d-none d-sm-flex"><span>${row.expert.img_url ? `<img src="${row.expert.img_url}" alt="">` : `<span class="text-white">N/A</span>`}</span></div>
                                <div class="user-info">
                                    <p class="fs-15px me-2 mb-0 text-dark">${row.expert.name}</p>
                                    <a href="${row.expert.url}" target="_blank" class="tw-underline hover:tw-text-blue-500 text-info"><span><i class="fa-brands text-info fa-linkedin fs-6 me-1"></i>${row.expert.url.replace('https://www.linkedin.com/in/','')}</span></a>
                                    <p class="mb-0"><span class="fs-13px">${row.expert.experiences[0].position}</span> • <span  class="fs-13px">${row.expert.experiences[0].company}</span></p>
                                </div>
                            </div>
                        </div>`
                    }
                },
                {
                    data: 'expert',
                    render: function (data, type, row) {
                        console.log(row)
                        let email = `<div class="d-flex tw-items-center"><i class="fa-solid fs-11px me-1 fa-envelope"></i>${row.expert.email === null ? '<i class="fa-solid fa-xmark text-danger me-1"></i>' : row.expert.email}</div>`;
                        let phone = `<div class="d-flex tw-items-center"><i class="fa-solid fs-11px me-1 fa-phone"></i>${row.expert.phone === null ? '<i class="fa-solid fa-xmark text-danger me-1"></i>' : row.expert.phone}</div>`;
                        return email + phone;
                    }
                },
                {
                    data: 'invited',
                    render: function (data) {
                        let color = data === true ? 'success' : 'danger'
                        return `<span class="badge bg-${color} text-capitalize">${data ? 'Yes' : 'No'}</span>`;
                    }
                },
                {
                    data: 'accepted',
                    render: function (data, type, row) {
                        console.log('data is')
                        console.log(data)
                        if (data === null) return '-';
                        let color = data ? 'success' : 'danger'
                        return `<span class="badge bg-${color} text-capitalize">${data ? 'Accept' : (data === null ? 'No' : 'Reject')}</span>`;
                    }
                },
                {
                    data: 'answers',
                    className: 'clickable hover:tw-bg-slate-200 items-center answer-cell',
                    render: function (data) {
                        if (data === null) return '-';
                        return data.map((answer, index) => {
                            console.log(answer);
                            return `<span class="fs-12px">Q${index+1}</span> <i class="fa-solid ${answer === null ? 'fa-circle-xmark text-danger' : 'fa-circle-check text-success'} fs-6"></i>`;
                        }).join(' ');
                    }
                },
                {
                    data: 'id',
                    className: 'nk-tb-col-tools',
                    render: function (data, type, row) {
                        console.log(row)
                        return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a class="clickable" onclick="invite(${row.expert_id}, ${row.invited})"><em class="icon ni ni-user-add"></em><span>Invite To Project</span></a></li>
                                                <li><a class="clickable" onclick="setEmail(${row.expert_id}, '${row.expert.email}')"><em class="icon ni ni-mail"></em><span>Set Email</span></a></li>
                                                <li><a class="clickable" onclick="setPhone(${row.expert_id}, '${row.expert.phone}')"><em class="icon ni ni-call"></em><span>Set Phone</span></a></li>
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

        function setEmail(id, email) {
            // show Swal with input field to set contact for this expert
            Swal.fire({
                title: 'Set Contact',
                input: 'text',
                inputLabel: 'Contact',
                inputPlaceholder: 'Enter contact',
                inputValue: email === 'null' ? '' : email,
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
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

        function setPhone(id, phone) {
            // show Swal with input field to set contact for this expert
            Swal.fire({
                title: 'Set Contact',
                input: 'text',
                inputLabel: 'Contact',
                inputPlaceholder: 'Enter contact',
                inputValue: phone === 'null' ? '' : phone,
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
                },
                allowOutsideClick: () => !Swal.isLoading()
            })
        }

        function invite(expert_id, invited) {
            if (invited) {
                Swal.fire({
                    title: 'Already Invited',
                    text: "Do you want to send invitation again?",
                    icon: 'info',
                    showCancelButton: true,
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
                title: 'Send Invitation?',
                text: "Send invitation to all uninvited shortlisted expert? Already send invitation will not be send again. Confirm?",
                icon: 'info',
                showCancelButton: true,
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
            })
        }

        function awardProject(){
            Swal.fire({
                title: 'Award Project to Expert?',
                text: "Proceed to awarding project to an expert? This will mark the project as 'Awarded'. Confirm?",
                icon: 'info',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.award', ['pid' => $project->pid])}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (data) {
                            _Swal.loadingCallback('Finalize Accept List', 'Getting list of expert that accepting invitation. Please wait...', 1000, function () {
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
            });
        }

    </script>
@endpush
