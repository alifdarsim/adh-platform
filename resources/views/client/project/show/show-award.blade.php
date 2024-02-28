<div class="modal fade" tabindex="-1" id="modalAward">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title">Choose Expert to Award this Project</h5>
                </div>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close"><em
                        class="icon ni ni-cross"></em></a>
            </div>
            <div class="modal-body p-0">
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
                    <table id="datatable3" class="datatable-init nk-tb-list nk-tb-ulist"
                           data-auto-responsive="true">
                        <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col"><span class="sub-text">Expert</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Contact</span></th>
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
                            return `
                        <div class="d-flex justify-between justify-center tw-items-center">
                             <a class="user-card" href="${row.expert.email}"  target="_blank">
                                <div class="user-avatar bg-dim-primary d-none d-sm-flex"><span>${row.expert.img_url ? `<img src="${row.expert.img_url}" alt="">` : `<span class="text-white">N/A</span>`}</span></div>
                                <div class="user-info">
                                    <span class="fs-15px me-2">${row.expert.name}</span>• <span><i class="fa-brands text-info fa-linkedin fs-6 mx-1"></i>${row.expert.url.replace('https://www.linkedin.com/in/', '')}</span>
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
                        data: 'id',
                        render: function (data, type, row) {
                            return `<a class="btn btn-sm btn-primary clickable" onclick="awarded(${row.expert.id})"><em class="icon ni ni-user-add"></em><span>Award To Expert</span></a>`
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

        function openAwardModal() {
            if (!$.fn.DataTable.isDataTable('#datatable3')) fetchAwardList();
            else $('#datatable3').DataTable().ajax.reload();
            _Swal.loadingCallback('Loading experts', 'Getting list of expert that accepting invitation. Please wait...', 1000, function () {
                $('#modalAward').modal('show');
            });
        }
    </script>
@endpush
