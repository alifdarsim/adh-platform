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
                               id="searchbar3" placeholder="Search Expert Name">
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
            <th class="nk-tb-col"><span class="sub-text">Details</span></th>
            <th class="nk-tb-col"><span class="sub-text">Action</span></th>
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
                ],
                simpleTable: true,
                columns: [
                    {
                        data: 'expert',
                        render: function (data, type, row) {
                            console.log(data)
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
                        data: 'id',
                        render: function (data, type, row) {
                            return `<a class="btn btn-sm btn-info clickable" onclick="expert_detail(${row.expert.id})"><span>Expert Details</span></a>`
                        },
                    },
                    {
                        data: 'id',
                        render: function (data, type, row) {
                            return `<a class="btn btn-sm btn-primary clickable" onclick="awarded(${row.expert.id})"><i class="fa-solid fa-award me-1 fs-6"></i><span>Award this Expert</span></a>`
                        },
                    },
                ]
            }, 'datatable3');
        }

        function awarded(id) {
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
    </script>
@endpush
