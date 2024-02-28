<div class="nk-block-between mt-2">
    <div class="nk-block-head-content">
        <h5 class="title mb-1 mt-4 pb-1">Shortlist Expert</h5>
    </div>
</div>
<div class="card card-bordered card-preview">
    <div class="card-inner position-relative card-tools-toggle py-3">
        <div class="card-title-group">
            <div class="card-tools">
                <div class="form-inline flex-nowrap gx-3">
                    <div class="form-control-wrap">
                        <div class="form-icon form-icon-left form-control"><i class="fa-regular fa-magnifying-glass"></i></div>
                        <input type="text" class="tw-w-96 form-control form-control tw-rounded !tw-ps-12 focus:tw-border focus:tw-border-blue-500" id="searchbar2" placeholder="Search Expert Name">
                    </div>
                </div>
            </div>
            <div class="card-tools me-n1">
                <ul class="btn-toolbar gx-1">
                    <button id="award_btn" class="btn btn-sm bg-outline-info hover:tw-text-white hover:tw-bg-blue-500 {{$project->status == 'pending' ? 'disabled' : ''}}" onclick="inviteAll()"><i class="fa-solid fa-envelope fs-6 tw-ms-0.5 me-3"></i><span>Invite All</span></button>
                    <button id="add_expert_btn" class="ms-2 btn btn-sm bg-outline-info  hover:tw-text-white hover:tw-bg-blue-500 {{$project->status == 'pending' ? 'disabled' : ''}}" onclick="openModal()"><em class="icon ni ni-plus"></em><span>Add Shortlisted Expert</span></button>
                </ul>
            </div>
        </div>
    </div><!-- .card-inner -->
    <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
        <thead>
        <tr class="nk-tb-item nk-tb-head">
            <th class="nk-tb-col"><span class="sub-text">Expert</span></th>
            <th class="nk-tb-col"><span class="sub-text">Contact</span></th>
            <th class="nk-tb-col"><span class="sub-text">Invite</span></th>
            <th class="nk-tb-col"><span class="sub-text">Respond</span></th>
            <th class="nk-tb-col nk-tb-col-tools text-end noExport">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@push('scripts')
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>
    <script>
        datatableInit('#datatable', {
            ajax: '{{route('admin.projects.datatable_shortlist', $project->pid)}}',
            order:  false,
            columnDefs: [
                { "className": "nk-tb-col", targets: '_all'},
            ],
            simpleTable: true,
            columns: [
                {
                    data: 'expert',
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex justify-between justify-center tw-items-center">
                             <a class="user-card" href="${row.expert.url}"  target="_blank">
                                <div class="user-avatar bg-dim-primary d-none d-sm-flex"><span>${row.expert.img_url ? `<img src="${row.expert.img_url}" alt="">` : `<span class="text-white">N/A</span>`}</span></div>
                                <div class="user-info">
                                    <span class="fs-15px me-2">${row.expert.name}</span>• <span><i class="fa-brands text-info fa-linkedin fs-6 mx-1"></i>${row.expert.url.replace('https://www.linkedin.com/in/','')}</span>
                                    <p class="mb-0"><span class="fs-13px">${row.expert.experiences[0].position}</span> • <span  class="fs-13px">${row.expert.experiences[0].company}</span> • <span class="fs-13px">${row.expert.experiences[0].duration}</span></p>
                                </div>
                            </a>
                        </div>`
                    }
                },
                {
                    data: 'expert',
                    render: function (data, type, row) {
                        return `<div class="user-info">
                                    <span class="mb-0 me-2"><i class="fa-solid fa-envelope me-1"></i>${row.expert.email ?? 'Not Set'}</span>
                                </div>`
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
                    render: function (data) {
                        let color = data ? 'success' : 'danger'
                        return `<span class="badge bg-${color} text-capitalize">${data ? 'Accept' : (data === null ? 'Pending' : 'Reject')}</span>`;
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
                                                <li><a class="clickable" onclick="invite(${row.expert_id})"><em class="icon ni ni-user-add"></em><span>Invite To Project</span></a></li>
                                                <li><a class="clickable" onclick="setContact(${row.expert_id})"><em class="icon ni ni-mail"></em><span>Set Contact</span></a></li>
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

        function setContact(id) {
            // show Swal with input field to set contact for this expert
            Swal.fire({
                title: 'Set Contact',
                input: 'text',
                inputLabel: 'Contact',
                inputPlaceholder: 'Enter contact',
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

        function invite(expert_id) {
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
            })
        }

        function openModal() {
            $('#modal-expert-list').modal('show');
        }

        function inviteAll(){
            Swal.fire({
                title: 'Send Invitation?',
                text: "Send invitation to all uninvited shortlisted expert?",
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

    </script>
@endpush
