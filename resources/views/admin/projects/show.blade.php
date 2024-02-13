@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title"><a class="back" href="{{route('admin.projects.index')}}"><i class="fa-solid fa-arrow-left me-2 fs-4"></i></a>{{$project->name}}</h3>
            </div>
        </div>
    </div>
    <div class="nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <div class="tw-flex tw-justify-between">
                    <div>
                        <div class="me-4"><strong>Project Name:</strong> {{$project->name}}</div>
                        <div class="me-4"><strong>Project ID:</strong> {{request()->segment(3)}}</div>
                    </div>
                    <div id="status-btn" class="drodown">
                        @if($project->status == 'awarded')
                            <h6>Project Status</h6>
                            <a class="tw-cursor-default dropdown-toggle btn btn-info">
                                <span class="tw-uppercase">Awarded to Expert</span>
                            </a>
                        @else
                            <a href="#" class="dropdown-toggle btn {{$project->status == 'pending' ? 'btn-danger' : ($project->status == 'active' ? 'btn-success' : 'btn-info')}}" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="tw-uppercase">{{$project->status == 'pending' ? 'Pending Approval' : ($project->status == 'active' ? 'Project is Active' : $project->status)}}</span><em class="dd-indc icon ni ni-chevron-down"></em>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="">
                                <ul class="link-list-opt no-bdr">
                                    <li><a class="clickable" onclick="respond('active')"><em class="d-none d-sm-inline icon ni ni-check"></em><span>Approve (Set to Active)</span></a></li>
                                    <li><a class="clickable" onclick="respond('reject')"><em class="d-none d-sm-inline icon ni ni-cross"></em><span>Reject Project</span></a></li>
                                    <li><a class="clickable" onclick="award()"><i class="fa-solid fa-award fs-5 tw-ms-0.5 me-3"></i><span>Awarding Project</span></a></li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="nk-block-between mt-2">
            <div class="nk-block-head-content">
                <h5 class="title mb-1 mt-4 pb-1">List of Invited Expert</h5>
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
                            <button class="btn btn-sm bg-outline-primary hover:tw-text-white hover:tw-bg-red-500" onclick="openAwardModal()"><i class="fa-solid fa-award fs-6 tw-ms-0.5 me-3"></i><span>Awarding Project</span></button>
                            <button id="add_expert_btn" class="ms-2 btn btn-sm bg-outline-info  hover:tw-text-white hover:tw-bg-blue-500 {{$project->status == 'pending' ? 'disabled' : ''}}" onclick="openModal()"><em class="icon ni ni-plus"></em><span>Search Expert to Invited List</span></button>
                        </ul>
                    </div>
                </div>
            </div><!-- .card-inner -->
            <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col"><span class="sub-text">Expert</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Contact</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Notify?</span></th>
                    <th class="nk-tb-col"><span class="sub-text">Respond</span></th>
                    <th class="nk-tb-col nk-tb-col-tools text-end noExport">Action</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        @include('admin.projects.show-detail')
    </div>
    <div class="modal fade" tabindex="-1" id="modalDefault">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row gx-2">
                        <div class="col-3">
                            <div class="card card-bordered card-preview tw-h-full">
                                <div class="fs-7 text-primary px-3 py-2 clickable" id="clear_search"><em class="icon ni ni-trash"></em>Clear Search</div>
                                <div class="border border-light"></div>
                                <div class="px-3 py-2">
                                    <div class="form-group">
                                        <label class="form-label" for="0">Job Role</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control column_filter tagify" id="0" placeholder="Jobs Title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control column_filter tagify" id="1" placeholder="Current Role">
                                        </div>
                                    </div>
                                </div>
                                <div class="px-3 pt-2">
                                    <div class="form-group">
                                        <label class="form-label" for="2">Company</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control column_filter tagify" id="2" placeholder="Search Company">
                                        </div>
                                    </div>
                                </div>
                                <div class="px-3 pt-2">
                                    <div class="form-group">
                                        <label class="form-label" for="4">Skills</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control column_filter tagify" id="4" placeholder="Search Skills">
                                        </div>
                                    </div>
                                </div>
                                <div class="px-3 pt-2 pb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="5">Country</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control column_filter tagify" id="5" placeholder="Country">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="card card-bordered card-preview">
                                <table id="datatable_2" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                                    <thead>
                                    <tr class="nk-tb-item nk-tb-head">
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Name</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Position</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Company</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
                                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Expert List</span></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modalAward">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title">Choose Expert to Award this Project</h5>
                        <p class="mb-0">Number of expert accepting invitation is <span id="expert_accept">1</span></p>
                    </div>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em class="icon ni ni-cross"></em></a>
                </div>
                <div class="modal-body p-0">
                    <div class="card card-bordered card-preview">
                        <div class="card-inner position-relative card-tools-toggle py-3">
                            <div class="card-title-group">
                                <div class="card-tools">
                                    <div class="form-inline flex-nowrap gx-3">
                                        <div class="form-control-wrap">
                                            <div class="form-icon form-icon-left form-control"><i class="fa-regular fa-magnifying-glass"></i></div>
                                            <input type="text" class="tw-w-96 form-control form-control tw-rounded !tw-ps-12 focus:tw-border focus:tw-border-blue-500" id="searchbar3" placeholder="Search Expert Name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="datatable3" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="true">
                            <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col"><span class="sub-text">Expert</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Contact</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Invited?</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Respond</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('scripts')
    <script src="/assets/js/libs/tagify.js?ver=3.2.2"></script>
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="/assets/js/libs/datatable-init.js?ver=3.2.2"></script>
    <script>
        let tagsElement;
        $( document ).ready(function() {
            $('#communication_language').val({!! collect($project->projectTargetInfo->communication_language)->map(fn($item) =>  $item )->implode(',') !!}).trigger('change');
            $('#target_keyword').tagify().data('tagify').addTags('{{$project->keywords->pluck('name')->implode(',  ')}}');
            tagsElement = $('.tagify').tagify();
        });

        let lastClick = 0;
        const delay = 50;
        $('.tagify').on('change', function(e){
            if (lastClick >= (Date.now() - delay)) return;
            lastClick = Date.now();
            let value = e.target.value;
            let tagId = e.target.id;
            if (tagId === 'target_keyword') return;
            let regex = '';
            if (value.length !== 0) {
                let values = JSON.parse(value).map(item => item.value);
                regex = '(?=.*' + values.map(word => word.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')).join(')(?=.*') + ')';
            }
            console.log(tagId)
            table.column(tagId).search(regex, true, false ).draw();
        });

        datatableInit('#datatable', {
            ajax: '{{route('admin.projects.datatable_expert', $project->pid)}}',
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
<!--                                    <span class="mb-0 me-2"><i class="fa-solid fa-phone me-1"></i>${row.expert.phone ?? 'Not Set'}</span>-->
                                </div>`
                    }
                },
                {
                    data: 'invited',
                    render: function (data) {
                        let color = data === true ? 'success' : 'danger'
                        return `<span class="badge bg-${color} text-capitalize">${data}</span>`;
                    }
                },
                {
                    data: 'accepted',
                    render: function (data) {
                        let color = data === true ? 'success' : 'danger'
                        return `<span class="badge bg-${color} text-capitalize">${data ? 'Accept' : 'No Respond'}</span>`;
                    }
                },
                {
                    data: 'id',
                    className: 'nk-tb-col-tools',
                    render: function (data, type, row) {
                        console.log(data)
                        return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a class="clickable" onclick="invite(${row.id})"><em class="icon ni ni-user-add"></em><span>Invite To Project</span></a></li>
                                                <li><a class="clickable" onclick="setContact(${row.expert.id})"><em class="icon ni ni-mail"></em><span>Set Contact</span></a></li>
                                                <li><a class="clickable" onclick="remove(${row.expert.id})"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>`
                    },
                },
            ]
        }, 'datatable');

        datatableInit('#datatable_2', {
            ajax: '{{route('admin.experts.datatable')}}',
            order:  false,
            simpleTable: true,
            pageLength: 6,
            columnDefs: [
                { "className": "nk-tb-col py-2", targets: [-1], visible: true},
                { targets: '_all', visible: false}
            ],
            columns: [
                {
                    data: 'positions'
                },
                {
                    data: 'position'
                },
                {
                    data: 'companies'
                },
                {
                    data: 'company'
                },
                {
                    data: 'skill_list',
                },
                {
                    data: 'country'
                },
                {
                    data: 'name',
                    render: function (data, type, row) {
                        return `
                        <div class="d-flex justify-between justify-center tw-items-center">
                             <a class="user-card" href="${row.url}"  target="_blank">
                                <div class="user-avatar bg-dim-primary d-none d-sm-flex"><span>${row.img_url ? `<img src="${row.img_url}" alt="">` : `<span class="text-white">N/A</span>`}</span></div>
                                <div class="user-info">
                                    <span class="fs-17px me-2">${data}</span><span><i class="fa-brands text-info fa-linkedin fs-6 me-1"></i>${row.url.replace('https://www.linkedin.com/in/','')}</span>
                                    <p class="mb-0"><span class="fs-13px">${row.position}</span> • <span  class="fs-13px">${row.company}</span> • <span class="fs-13px">${row.experiences[0].duration}</span></p>
                                    <p class="mb-0"><span class="fs-13px">${row.address}, ${row.country}</span></p>
                                </div>
                            </a>
                            <div><btn id="add_${row.id}" class="btn btn-sm btn-primary ms-1" onclick="addExpert(${row.id})">Add</btn></div>
                        </div>`
                    }
                },
            ]
        }, 'datatable_2');

        $('#clear_search').click(function () {
            tagsElement.data('tagify').removeAllTags();
            table.columns().search('').draw();
        });

        function addExpert(id){
            console.log(window['datatable'])
            $(`#add_${id}`).text('Added').addClass('disabled');
            $.ajax({
                url: '{{route('admin.projects.add-expert')}}',
                type: 'POST',
                data: {
                    expert_id: id,
                    pid: '{{$project->pid}}',
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    window['datatable'].ajax.reload();

                },
                error: function (data) {
                    _Swal.error(data.responseJSON.message)
                }
            });
        }

        function remove(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
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

        function setContact(id){
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

        function invite(id){
            console.log(id)
            Swal.fire({
                title: 'Are you sure?',
                text: "Send invitation to this expert?",
                icon: 'info',
                showCancelButton: true,
            }).then((result) => {
                _Swal.loading('Sending invitation', 'Pleas wait...');
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.invite-expert','')}}/' + id,
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

        function sendRespond(status){
            $.ajax({
                url: "{{route('admin.projects.respond', '')}}/{{$project->pid}}",
                type: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    status: status
                },
                success: function (data) {
                    Swal.fire('Success!', data.message,'success').then(function () {
                        $('#status-btn').html(`<a href="#" class="dropdown-toggle btn ${status === 'pending' ? 'btn-warning' : (status === 'active' ? 'btn-info' : 'btn-primary btn-dim')}" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="tw-uppercase">${status === 'active' ? 'Project is Active' : (status === 'pending' ? 'Pending Approval' : status)}</span><em class="dd-indc icon ni ni-chevron-down"></em>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" style="">
                            <ul class="link-list-opt no-bdr">
                                <li><a class="clickable" onclick="respond('active')"><em class="d-none d-sm-inline icon ni ni-check"></em><span>Approve (Set to Active)</span></a></li>
                                <li><a class="clickable" onclick="respond('pending')"><em class="d-none d-sm-inline icon ni ni-cross"></em><span>Set to Pending</span></a></li>
                            </ul>
                        </div>`);
                        $('#add_expert_btn').removeClass('disabled');
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

        function respond(status) {
            let current_stat = '{{$project->status}}';
            if (status === current_stat) {
                Swal.fire('Warning!', 'Project is already ' + status, 'warning');
                return;
            }
            if (status === 'pending')
                Swal.fire({
                    title: 'Warning!',
                    text: 'This will remove project from appear in expert project list. Make sure you know what are you doing',
                    icon: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendRespond(status);
                    }
                });
            else if (status === 'reject')
                Swal.fire({
                    title: 'Reject Project?',
                    text: 'Rejecting project will mark the project as reject and no further action can be taken. Confirm?',
                    icon: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        sendRespond(status);
                    }
                });
            else sendRespond(status);
        }

        function openModal(){
            $('#modalDefault').modal('show');
        }

        function openAwardModal(){
            _Swal.loadingCallback('Loading experts', 'Getting list of expert that accepting invitation. Please wait...', 1000, function () {
                $('#modalAward').modal('show');
            });
        }

        function awarded(id){
            Swal.fire({
                title: 'Confirm Award?',
                text: "Award this project to this expert? This will mark the project as 'Awarded'. Confirm?",
                icon: 'info',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{route('admin.projects.award-expert', ['pid' => $project->pid])}}',
                        type: 'POST',
                        data: {
                            _token: '{{csrf_token()}}',
                            expert_id: id
                        },
                        success: function (data) {
                            Swal.fire('Success!', data.message,'success').then(function () {
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

        datatableInit('#datatable3', {
            ajax: '{{route('admin.projects.datatable_awarding', $project->pid)}}',
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
                        let color = data === true ? 'success' : 'warning'
                        return `<span class="badge bg-${color} text-capitalize">${data}</span>`;
                    }
                },
                {
                    data: 'accepted',
                    render: function (data) {
                        let color = data === true ? 'success' : 'warning'
                        return `<span class="badge bg-${color} text-capitalize">${data ?? 'No Respond'}</span>`;
                    }
                },
                {
                    data: 'expert_id',
                    render: function (data, type, row) {
                        return `<a class="btn btn-sm btn-primary clickable" onclick="awarded(${data})"><em class="icon ni ni-user-add"></em><span>Award To Expert</span></a>`
                    },
                },
            ]
        }, 'datatable3');
    </script>
@endpush
