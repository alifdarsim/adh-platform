@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Users List</h3>
                <div class="nk-block-des text-soft">
                    <p>Total numbers of users: {{$usersCount}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table id="datatable" class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">User</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Roles</span></th>
                        <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col tb-col-lg"><span class="sub-text">Last Access</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            <div class="user-card">
                                <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                    <span>AB</span>
                                </div>
                                <div class="user-info">
                                    <span class="tb-lead">Abu Bin Ishtiyak <span class="dot dot-success d-md-none ms-1"></span></span>
                                    <span>info@softnio.com</span>
                                </div>
                            </div>
                        </td>
                        <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                            <ul class="list-status">
                                <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                <li><em class="icon ni ni-alert-circle"></em> <span>KYC</span></li>
                            </ul>
                        </td>
                        <td class="nk-tb-col tb-col-lg">
                            <span>05 Oct 2019</span>
                        </td>
                        <td class="nk-tb-col tb-col-md">
                            <span class="tb-status text-success">Active</span>
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li class="nk-tb-action-hidden">
                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Wallet">
                                        <em class="icon ni ni-wallet-fill"></em>
                                    </a>
                                </li>
                                <li class="nk-tb-action-hidden">
                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Send Email">
                                        <em class="icon ni ni-mail-fill"></em>
                                    </a>
                                </li>
                                <li class="nk-tb-action-hidden">
                                    <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Suspend">
                                        <em class="icon ni ni-user-cross-fill"></em>
                                    </a>
                                </li>
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick View</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-repeat"></em><span>Transaction</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activities</span></a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="/assets/js/libs/datatable-btns.js?ver=3.2.2"></script>
    <script>
        $(function () {

            let has_export = true;
            let btn = has_export ? '<"dt-export-buttons d-flex align-center"<"dt-export-title d-none d-md-inline-block">B>' : '',
                btn_cls = has_export ? ' with-export' : '';
            let dom_normal = '<"row justify-between g-2' + btn_cls + '"<"col-7 col-sm-4 text-start"f><"col-5 col-sm-8 text-end"<"datatable-filter"<"d-flex justify-content-end g-2"' + btn + 'l>>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-start text-md-end"i>>';
            let dom_separate = '<"row justify-between g-2' + btn_cls + '"<"col-7 col-sm-4 text-start"f><"col-5 col-sm-8 text-end"<"datatable-filter"<"d-flex justify-content-end g-2"' + btn + 'l>>>><"my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-start text-md-end"i>>';
            let dom = $(this).hasClass('is-separate') ? dom_separate : dom_normal;

            $('#datatable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                responsive: {
                    details: true
                },
                autoWidth: false,
                dom: dom,
                ajax: "{{ route('admin.users.datatable') }}",
                buttons: ['copy', 'excel', 'csv', 'pdf'],
                columns: [
                    {
                        data: 'name',
                        className: 'nk-tb-col',
                        render: function (data, type, row) {
                            return `
                              <div class="user-card">
                                    <div class="user-avatar bg-primary d-none d-sm-flex">
                                        <span>AD</span>
                                    </div>
                                    <div class="user-info">
                                        <span class="tb-lead">${data}<span
                                                class="dot dot-success d-md-none ms-1"></span></span>
                                        <span>${row.email}</span>
                                    </div>
                                </div>`
                        }
                    },
                    {
                        data: 'role',
                        render: function (data, type, row) {
                            return `<span class="badge badge-dot bg-info text-capitalize">${data}</span>`
                        },
                        className: 'nk-tb-col'
                    },
                    {
                        data: 'status',
                        render: function (data) {
                            let status = data === 1 ? 'Active' : data === 2 ? 'Suspend' : 'Invited';
                            let color = data === 1 ? 'success' : data === 2 ? 'warning' : 'danger';
                            return ` <span class="badge badge-dot text-capitalize bg-${color}">${status}</span>`
                        },
                        className: 'nk-tb-col'
                    },
                    {
                        data: 'last_login_at',
                        className: 'nk-tb-col'
                    },
                    {
                        data: 'id',
                        className: 'nk-tb-col nk-tb-col-tools',
                        render: function (data) {
                            return `<ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a onclick="edit(${data})"><em class="icon ni ni-pen"></em><span>Edit</span></a></li>
                                                <li><a onclick="remove(${data})"><em class="icon ni ni-trash"></em><span>Remove</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>`
                        }
                    },
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('nk-tb-item');
                },
                initComplete: function () {
                    $('[data-bs-toggle="tooltip"]').tooltip();
                    // get total of row
                    // this.api().columns().every(function () {
                    //     let column = this;
                    //     let input = document.createElement("input");
                    //     $(input).addClass('form-control form-control-sm');
                    //     $(input).attr("placeholder", "Search");
                    //     $(input).appendTo($(column.header()).empty())
                    //         .on('keyup', function () {
                    //             column.search($(this).val(), false, false, true).draw();
                    //         });
                    // });
                },
                language: {
                    search: "",
                    searchPlaceholder: "Type in to Search",
                    lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                    info: "_START_ -_END_ of _TOTAL_",
                    infoEmpty: "0",
                    infoFiltered: "( Total _MAX_  )",
                }
            });


        });

        function remove(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this action!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e14954',
                cancelButtonColor: '#495057',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('admin.admins.destroy', '')}}/" + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{csrf_token()}}'
                        },
                        success: function (res) {
                            _Swal.success(res.message);
                            $('#datatable').DataTable().ajax.reload();
                        },
                        error: function (res) {
                            _Swal.error(res.responseJSON.message);
                        }
                    })
                }
            })
        }
    </script>
@endpush
